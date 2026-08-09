<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\ItemComment;
use App\Models\ItemReview;
use App\Models\Category;

class ProductRepository
{
    public function getFilteredActiveItems(array $filters, int $perPage = 10)
    {
        return Item::query()
            ->with(['category', 'sub_category', 'author'])
            ->withAvg('reviews', 'stars')
            ->withCount(['reviews', 'sales'])
            ->where('status', 'active')
            ->when(
                !empty($filters['category']),
                fn($q) =>
                $q->whereHas('category', fn($sub) => $sub->where('slug', $filters['category']))
            )
            ->when(
                !empty($filters['search']),
                fn($q) =>
                $q->where(
                    fn($sub) =>
                    $sub->where('name', 'LIKE', '%' . $filters['search'] . '%')
                        ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%')
                )
            )
            ->when(
                !empty($filters['rating']),
                fn($q) =>
                $q->whereHas('reviews', fn($sub) => $sub->where('stars', $filters['rating']))
            )
            ->when(
                !empty($filters['price']),
                fn($q) =>
                $q->where(
                    fn($sub) =>
                    $sub->where('price', '<=', $filters['price'])
                        ->orWhere('discount_price', '<=', $filters['price'])
                )
            )
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getCategoriesWithActiveItemsCount()
    {
        return Category::withCount(['items' => fn($q) => $q->where('status', 'active')])->get();
    }

    public function getTotalActiveItemsCount(): int
    {
        return Item::where('status', 'active')->count();
    }

    public function getItemsCountGroupedByRating()
    {
        return ItemReview::selectRaw('ROUND(stars) as rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');
    }

    public function getActiveItemBySlug(string $slug)
    {
        return Item::with(['category', 'sub_category', 'author'])
            ->withCount(['comments', 'reviews', 'sales'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function getItemComments(int $itemId, int $perPage = 25)
    {
        return ItemComment::with('user')->where('item_id', $itemId)->paginate($perPage);
    }

    public function getItemReviews(int $itemId, int $perPage = 25)
    {
        return ItemReview::with('user')->where('item_id', $itemId)->paginate($perPage);
    }

    public function findItemById(string $id)
    {
        return Item::findOrFail($id);
    }
}
