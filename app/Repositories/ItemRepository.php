<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\UploadedFiles;
use App\Models\ItemChangelog;
use App\Models\ItemHistory;
use Illuminate\Support\Facades\Auth;

class ItemRepository
{
    public function getPaginatedAuthorItems(int $perPage = 10)
    {
        return Item::with(['category', 'sub_category'])
            ->where('author_id', Auth::id())
            ->paginate($perPage);
    }

    public function findAuthorItemById(int $id): Item
    {
        return Item::where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();
    }

    public function getFilesByAuthorAndCategory(int $categoryId)
    {
        return UploadedFiles::where('author_id', Auth::id())
            ->where('category_id', $categoryId)
            ->get();
    }

    public function createItem(array $data): Item
    {
        return Item::create($data);
    }

    public function createHistory(array $data): ItemHistory
    {
        return ItemHistory::create($data);
    }

    public function createChangelog(array $data): ItemChangelog
    {
        return ItemChangelog::create($data);
    }

    public function getHistoryByItemId(int $itemId)
    {
        return ItemHistory::where('item_id', $itemId)->get();
    }

    public function clearAuthorUploadedFiles(): void
    {
        UploadedFiles::where('author_id', Auth::id())->delete();
    }
}
