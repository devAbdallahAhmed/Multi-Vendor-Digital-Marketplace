<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use App\Traits\FileUpload;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class ItemService
{
    use FileUpload;

    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function storeItem(array $validatedData, ?string $messageForReviewer): Item
    {
        return DB::transaction(function () use ($validatedData, $messageForReviewer) {

            $itemData = $validatedData;
            $itemData['category_id'] = $validatedData['category'] ?? null;
            $itemData['sub_category_id'] = $validatedData['sub_category'] ?? null;
            $itemData['author_id'] = Auth::id();
            $itemData['status'] = 'pending';

            $itemData['is_supported'] = $validatedData['support'] ?? 0;
            $itemData['is_free'] = $validatedData['is_free'] ?? 0;

            if (isset($validatedData['preview_type']) && in_array($validatedData['preview_type'], ['image', 'video', 'audio'])) {
                $itemData["preview_" . $validatedData['preview_type']] = $validatedData['preview_file'] ?? null;
            }

            $isUpload = (($validatedData['source_type'] ?? '') === 'upload');
            $itemData['is_main_file_external'] = $isUpload ? 0 : 1;
            $itemData['main_file'] = $isUpload ? ($validatedData['upload_source'] ?? null) : ($validatedData['link_source'] ?? null);

            unset(
                $itemData['category'],
                $itemData['sub_category'],
                $itemData['preview_file'],
                $itemData['source_type'],
                $itemData['upload_source'],
                $itemData['link_source'],
                $itemData['message_for_reviewer'],
                $itemData['support']
            );

            $item = $this->itemRepository->createItem($itemData);

            $this->itemRepository->createHistory([
                'author_id' => Auth::id(),
                'item_id'   => $item->id,
                'title'     => 'Initial submission',
                'body'      => $messageForReviewer,
                'status'    => 'pending'
            ]);

            if (!empty($validatedData['screenshots'])) {
                $this->movePublicAsset($validatedData['screenshots']);
            }

            $this->itemRepository->clearAuthorUploadedFiles();

            return $item;
        });
    }

    public function updateItem(Item $item, array $validatedData, ?string $messageForReviewer = null): Item
    {
        return DB::transaction(function () use ($item, $validatedData, $messageForReviewer) {

            $oldPreviewType = $item->preview_type;
            $oldPreviewFile = $item->{"preview_" . $oldPreviewType} ?? null;

            $itemData = $validatedData;
            if (isset($validatedData['category'])) {
                $itemData['category_id'] = $validatedData['category'];
            }
            if (isset($validatedData['sub_category'])) {
                $itemData['sub_category_id'] = $validatedData['sub_category'];
            }

            if (isset($validatedData['support'])) {
                $itemData['is_supported'] = $validatedData['support'];
            }
            if (isset($validatedData['is_free'])) {
                $itemData['is_free'] = $validatedData['is_free'];
            }

            $previewType = $validatedData['preview_type'] ?? $oldPreviewType;
            $itemData['preview_type'] = $previewType;

            if (!empty($validatedData['preview_file'])) {
                $itemData['preview_image'] = null;
                $itemData['preview_video'] = null;
                $itemData['preview_audio'] = null;

                $itemData["preview_" . $previewType] = $validatedData['preview_file'];
            }

            if (isset($validatedData['source_type'])) {
                $isUpload = ($validatedData['source_type'] === 'upload');
                $itemData['is_main_file_external'] = $isUpload ? 0 : 1;
                $itemData['main_file'] = $isUpload ? ($validatedData['upload_source'] ?? $item->main_file) : ($validatedData['link_source'] ?? $item->main_file);
            }

            if ($item->status === 'inactive') {
                $itemData['status'] = 'pending';
            }

            unset(
                $itemData['category'],
                $itemData['sub_category'],
                $itemData['preview_file'],
                $itemData['source_type'],
                $itemData['upload_source'],
                $itemData['link_source'],
                $itemData['message_for_reviewer'],
                $itemData['support']
            );

            $item->update($itemData);

            if (!empty($validatedData['screenshots'])) {
                $this->movePublicAsset($validatedData['screenshots']);
            }

            if (!empty($validatedData['preview_file']) && $oldPreviewFile && $validatedData['preview_file'] !== $oldPreviewFile) {
                $oldDisk = in_array($oldPreviewType, ['video', 'audio']) ? 'local' : 'public';
                $this->deleteFile($oldPreviewFile, $oldDisk);
            }

            return $item;
        });
    }

    public function storeChangelog(Item $item, array $validatedData)
    {
        return $this->itemRepository->createChangelog([
            'item_id'     => $item->id,
            'version'     => $validatedData['version'],
            'description' => $validatedData['description'],
        ]);
    }

    public function downloadFile(Item $item)
    {
        if ($item->is_main_file_external) {
            if (filter_var($item->main_file, FILTER_VALIDATE_URL)) {
                return ['type' => 'url', 'path' => $item->main_file];
            }
            abort(404, 'External link is invalid.');
        }

        $cleanPath = ltrim($item->main_file, '/');

        if (!Storage::disk('local')->exists($cleanPath)) {
            abort(404, 'The requested file does not exist on the server.');
        }

        return ['type' => 'file', 'path' => $cleanPath];
    }
}
