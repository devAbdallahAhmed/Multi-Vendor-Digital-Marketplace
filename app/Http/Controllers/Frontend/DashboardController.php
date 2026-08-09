<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemReview;

class DashboardController extends Controller
{
    function index()
    {
        return view('frontend.dashboard.index');
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
