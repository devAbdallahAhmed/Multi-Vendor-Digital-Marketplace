<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Models\HighlightedProduct;
use App\Models\Item;
use Illuminate\Support\Facades\Cache;

class HighlightedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highlightedData = Cache::remember('highlighted_products_data', 60 * 60 * 24, function () {
            $section = HighlightedProduct::first();
            $items = collect();

            if ($section && !empty($section->item_ids)) {
                $items = Item::whereIn('id', $section->item_ids)
                    ->select('id', 'name')
                    ->get();
            }
            return [
                'section' => $section,
                'items' => $items
            ];
        });
        $highlightedSection = $highlightedData['section'];
        $selectedItems = $highlightedData['items'];

        return view('admin.sections.highlighted-product.index', compact('highlightedSection', 'selectedItems'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'item_ids' => 'required|array',
        ]);

        HighlightedProduct::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'item_ids' => $request->item_ids,
            ]
        );
        Cache::forget('highlighted_products_data');
        NotificationService::updated('Section updated successfully.');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
