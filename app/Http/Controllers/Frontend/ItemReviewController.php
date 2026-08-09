<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemReview;
use App\Services\NotificationService;

class ItemReviewController extends Controller
{
    public function store(Request $request, string $id)
    {

        $request->validate([
            'rating' => 'required|numeric',
            'review'  => 'required|string|max:500'
        ]);

        $item = Item::findOrFail($id);
        $review = new ItemReview();
        $review->user_id  = auth()->id();
        $review->item_id = $item->id;
        $review->author_id = $item->author_id;
        $review->body = $request->review;
        $review->stars = $request->rating;
        $review->save();
        NotificationService::created();
        return redirect()->back();
    }
}
