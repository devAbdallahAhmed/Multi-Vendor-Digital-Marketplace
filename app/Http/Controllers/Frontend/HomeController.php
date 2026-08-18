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

        if ($featuredCategorySelection && !empty($featuredCategorySelection->category_ids)) {
            $subCategories = SubCategory::whereIn('id', $featuredCategorySelection->category_ids)->get();

            $items = Item::whereIn('sub_category_id', $featuredCategorySelection->category_ids)
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
        $highlightedProducts = collect();

        if ($highlightedSection && !empty($highlightedSection->item_ids)) {
            $highlightedProducts = $this->getBaseHighlightedProductsQuery($highlightedSection->item_ids)
                ->take(4)
                ->get();
        }

        $monthlyPickedSection = \App\Models\MonthlyPickedProduct::first();
        $monthlyPickedProducts = collect();

        if ($monthlyPickedSection && !empty($monthlyPickedSection->item_ids)) {
            $monthlyPickedProducts = $this->getBaseHighlightedProductsQuery($monthlyPickedSection->item_ids)
                ->take(8)
                ->get();
        }

        $featuredAuthorSection = \App\Models\FeaturedAuthorSection::first();
        $authorProducts = collect();

        if ($featuredAuthorSection && $featuredAuthorSection->author_id) {
            $authorProducts = Item::where('author_id', $featuredAuthorSection->author_id)
                ->where('status', 'active')
                ->withCount('reviews')
                ->withAvg('reviews', 'stars')
                ->latest()
                ->take(4)
                ->get();
        }
        $counterSection = \App\Models\CounterSection::first();
        $bannerSection = \App\Models\BannerSection::first();
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
        $highlightedProducts = collect();

        if ($highlightedSection && !empty($highlightedSection->item_ids)) {
            $highlightedProducts = $this->getBaseHighlightedProductsQuery($highlightedSection->item_ids)
                ->paginate(12);
        }

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
