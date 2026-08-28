<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\Category;
use App\Models\Item;
use App\Models\FeaturedCategory;
use App\Models\Admin\SubCategory;
use App\Models\HighlightedProduct;
use App\Models\MonthlyPickedProduct;
use App\Models\FeaturedAuthorSection;
use App\Models\CounterSection;
use App\Models\BannerSection;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = HeroSection::first();

        $featuredCategories = Category::where('show_at_featured', 1)
            ->withCount(['items' => fn($query) => $query->where('status', 'active')])
            ->get();

        $featuredCategorySelection = FeaturedCategory::first();
        $featuredItems = [];
        $featuredCategoryIds = $featuredCategorySelection?->category_ids ?? [];

        if (!empty($featuredCategoryIds)) {
            $subCategories = SubCategory::whereIn('id', $featuredCategoryIds)->get();

            $items = Item::whereIn('sub_category_id', $featuredCategoryIds)
                ->where('status', 'active')
                ->withAvg('reviews', 'stars')
                ->withCount(['reviews', 'sales'])
                ->latest()
                ->get()
                ->groupBy('sub_category_id');

            foreach ($subCategories as $subCategory) {
                $featuredItems[$subCategory->name] = isset($items[$subCategory->id])
                    ? $items[$subCategory->id]->take(8)
                    : collect();
            }
        }

        $highlightedSection = HighlightedProduct::first();
        $highlightedItemIds = $highlightedSection?->item_ids ?? [];
        $highlightedProducts = !empty($highlightedItemIds)
            ? $this->getBaseHighlightedProductsQuery($highlightedItemIds)->take(4)->get()
            : collect();

        $monthlyPickedSection = MonthlyPickedProduct::first();
        $monthlyItemIds = $monthlyPickedSection?->item_ids ?? [];
        $monthlyPickedProducts = !empty($monthlyItemIds)
            ? $this->getBaseHighlightedProductsQuery($monthlyItemIds)->take(8)->get()
            : collect();

        $featuredAuthorSection = FeaturedAuthorSection::first();
        $authorProducts = $featuredAuthorSection?->author_id
            ? Item::where('author_id', $featuredAuthorSection->author_id)
            ->where('status', 'active')
            ->withCount('reviews')
            ->withAvg('reviews', 'stars')
            ->latest()
            ->take(4)
            ->get()
            : collect();

        $counterSection = CounterSection::first();
        $bannerSection = BannerSection::first();

        return view('frontend.home.index', compact(
            'hero',
            'featuredCategories',
            'featuredItems',
            'highlightedSection',
            'highlightedProducts',
            'monthlyPickedSection',
            'monthlyPickedProducts',
            'featuredAuthorSection',
            'authorProducts',
            'counterSection',
            'bannerSection'
        ));
    }

    public function highlightedProducts(): View
    {
        $highlightedSection = HighlightedProduct::first();
        $highlightedItemIds = $highlightedSection?->item_ids ?? [];

        $highlightedProducts = !empty($highlightedItemIds)
            ? $this->getBaseHighlightedProductsQuery($highlightedItemIds)->paginate(12)
            : collect();

        return view('frontend.pages.highlighted-products', compact('highlightedSection', 'highlightedProducts'));
    }

    private function getBaseHighlightedProductsQuery(array $itemIds)
    {
        return Item::whereIn('id', $itemIds)
            ->where('status', 'active')
            ->withCount(['sales', 'reviews'])
            ->withAvg('reviews', 'stars')
            ->latest();
    }
}
