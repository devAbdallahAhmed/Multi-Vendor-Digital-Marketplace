<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use App\Traits\FileUpload;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $itemData = $validatedData;
        $itemData['category_id'] = $validatedData['category'];
        $itemData['sub_category_id'] = $validatedData['sub_category'];
        $itemData['author_id'] = Auth::id();
        $itemData['status'] = 'pending';

        if (in_array($validatedData['preview_type'] ?? '', ['image', 'video', 'audio'])) {
            $itemData["preview_" . $validatedData['preview_type']] = $validatedData['preview_file'];
        }

        $itemData['is_main_file_external'] = ($validatedData['source_type'] === 'upload') ? 0 : 1;
        $itemData['main_file'] = ($validatedData['source_type'] === 'upload') ? $validatedData['upload_source'] : $validatedData['link_source'];

        $item = $this->itemRepository->createItem($itemData);

        $this->movePublicAsset($validatedData['screenshots'] ?? [], $validatedData['preview_file'] ?? null);

        $this->itemRepository->createHistory([
            'author_id' => Auth::id(),
            'item_id'   => $item->id,
            'title'     => 'Initial submission',
            'body'      => $messageForReviewer,
            'status'    => 'pending'
        ]);

        $this->itemRepository->clearAuthorUploadedFiles();

        return $item;
    }

    public function updateItem(Item $item, array $validatedData): Item
    {
        $oldPreviewType = $item->preview_type;
        $oldPreviewFile = $item->{"preview_" . $oldPreviewType} ?? null;

        $item->fill($validatedData);

        $item->preview_image = null;
        $item->preview_video = null;
        $item->preview_audio = null;

        if (in_array($validatedData['preview_type'] ?? '', ['image', 'video', 'audio'])) {
            $propertyName = "preview_" . $validatedData['preview_type'];
            $item->{$propertyName} = $validatedData['preview_file'];
        }

        if (isset($validatedData['source_type'])) {
            $item->is_main_file_external = ($validatedData['source_type'] === 'upload') ? 0 : 1;
            $item->main_file = ($validatedData['source_type'] === 'upload') ? $validatedData['upload_source'] : $validatedData['link_source'];
        }

        if ($item->status === 'soft_reject') {
            $item->status = 'resubmitted';
        }

        $item->save();

        $this->movePublicAsset($validatedData['screenshots'] ?? [], $validatedData['preview_file'] ?? null);

        if (($validatedData['preview_file'] ?? null) && $oldPreviewFile && $validatedData['preview_file'] !== $oldPreviewFile) {
            $this->deleteFile($oldPreviewFile, 'public');
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
        $storagePath = storage_path('app/private/' . $cleanPath);

        if (!File::exists($storagePath)) {
            abort(404, 'The requested file does not exist on the server.');
        }

        return ['type' => 'file', 'path' => $storagePath];
    }
}
