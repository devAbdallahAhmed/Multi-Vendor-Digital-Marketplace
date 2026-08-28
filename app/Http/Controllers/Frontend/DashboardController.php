<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemReview;

class DashboardController extends Controller
{
    function index()
    {
        $purchaseCount = \App\Models\Purchase::where('user_id', auth()->id())->count();
        $reviewCount = \App\Models\ItemReview::where('user_id', auth()->id())->count();
        $totalSpend = \App\Models\PurchaseItem::where('user_id', auth()->id())->sum('price');

        return view('frontend.dashboard.index', compact('purchaseCount', 'reviewCount', 'totalSpend'));
    }

    public function reviews()
    {
        $reviews = ItemReview::with(['item.category', 'item.sub_category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('frontend.dashboard.review', compact('reviews'));
    }
}
