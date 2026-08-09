<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $itemRepository;

    public function __construct(ProductRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getProductsPageData(array $filters): array
    {
        return [
            'items' => $this->itemRepository->getFilteredActiveItems($filters),
            'categories' => $this->itemRepository->getCategoriesWithActiveItemsCount(),
            'totalProductsCount' => $this->itemRepository->getTotalActiveItemsCount(),
            'productCountByRating' => $this->itemRepository->getItemsCountGroupedByRating(),
        ];
    }

    public function getProductDetailsPageData(string $slug): array
    {
        $item = $this->itemRepository->getActiveItemBySlug($slug);

        return [
            'item' => $item,
            'comments' => $this->itemRepository->getItemComments($item->id),
            'reviews' => $this->itemRepository->getItemReviews($item->id),
        ];
    }

    public function getStreamPreviewResponse(string $id)
    {
        $item = $this->itemRepository->findItemById($id);

        $propertyName = "preview_" . $item->preview_type;
        $cleanPath = 'private/' . ltrim($item->{$propertyName}, '/');

        if (!Storage::exists($cleanPath)) {
            abort(404, 'File not found on disk');
        }

        return Storage::response($cleanPath);
    }
}
