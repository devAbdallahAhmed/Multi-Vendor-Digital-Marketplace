<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use App\Traits\FileUpload;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;

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
                $itemData['message_for_reviewer']
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

    public function updateItem(Item $item, array $validatedData): Item
    {
        $oldPreviewType = $item->preview_type;
        $oldPreviewFile = $item->{"preview_" . $oldPreviewType} ?? null;

        $item->fill($validatedData);
        if (!empty($validatedData['preview_file'])) {
            $item->preview_image = null;
            $item->preview_video = null;
            $item->preview_audio = null;

            $item->preview_type = $validatedData['preview_type'];
            $propertyName = "preview_" . $validatedData['preview_type'];
            $item->{$propertyName} = $validatedData['preview_file'];
        } else {
            $item->preview_type = $oldPreviewType;
        }

        if (isset($validatedData['source_type'])) {
            if (!empty($validatedData['upload_source']) || !empty($validatedData['link_source'])) {
                $item->is_main_file_external = ($validatedData['source_type'] === 'upload') ? 0 : 1;
                $item->main_file = ($validatedData['source_type'] === 'upload') ? $validatedData['upload_source'] : $validatedData['link_source'];
            }
        }
        if ($item->status === 'soft_reject') {
            $item->status = 'resubmitted';
        }

        $item->save();

        $this->movePublicAsset($validatedData['screenshots'] ?? []);

        if (($validatedData['preview_file'] ?? null) && $oldPreviewFile && $validatedData['preview_file'] !== $oldPreviewFile) {
            $oldDisk = in_array($oldPreviewType, ['video', 'audio']) ? 'local' : 'public';
            $this->deleteFile($oldPreviewFile, $oldDisk);
        }

        return $item;
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
