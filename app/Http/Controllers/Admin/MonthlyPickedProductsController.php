<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonthlyPickedProduct;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\NotificationService;


class MonthlyPickedProductsController extends Controller
{
    public function index()
    {
        $monthlyPickedSection = MonthlyPickedProduct::first();
        $selectedItems = collect();

        if ($monthlyPickedSection && !empty($monthlyPickedSection->item_ids)) {
            $selectedItems = Item::whereIn('id', $monthlyPickedSection->item_ids)
                ->select('id', 'name')
                ->get();
        }

        return view('admin.sections.monthly-picked-product.index', compact('monthlyPickedSection', 'selectedItems'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'item_ids' => 'required|array',
        ]);

        MonthlyPickedProduct::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'content' => $request->content,
                'item_ids' => $request->item_ids,
            ]
        );
        NotificationService::updated('Monthly Picked Products Section updated successfully.');
        return redirect()->back();
    }
}
