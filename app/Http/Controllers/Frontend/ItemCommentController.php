<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemComment;
use App\Http\Requests\StoreItemCommentRequest;
use App\Http\Requests\UpdateItemCommentRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemCommentRequest $request, $id)
    {
        $request->validated();
        $item = Item::findOrFail($id);
        ItemComment::create([
            'item_id' => $item->id,
            'user_id' => auth()->id(),
            'body' => $request->message
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemComment $itemComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemComment $itemComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemCommentRequest $request, ItemComment $itemComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemComment $itemComment)
    {
        //
    }
}
