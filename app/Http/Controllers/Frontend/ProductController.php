<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Item;
use App\Services\ItemService;
use App\Repositories\ItemRepository;
class ProductController extends Controller
{
    protected $itemService;
    protected $itemRepository;

    public function __construct(ItemService $itemService, ItemRepository $itemRepository)
    {
        $this->itemService = $itemService;
        $this->itemRepository = $itemRepository;
    }
    public function index(Request $request)
    {
        $items = Item::with(['category', 'sub_category'])
            ->where('status', 'active')->get();
        $categorySlug = $request->query('category');
        $SubcategoriesSlug = $request->query('sub-category');

        return view('frontend.pages.products', compact(
            'items',
            'categorySlug',
            'SubcategoriesSlug'
        ));
    }

    public function show($slug)
    {
        $items = Item::with(['category', 'sub_category'])->where('slug', $slug)
            ->where('status', 'active')->firstOrFail();
        return view('frontend.pages.product-details', compact('items'));
    }



    public function streamPreview(string $id)
    {
        $item = \App\Models\Item::findOrFail($id);
        $propertyName = "preview_" . $item->preview_type;
        $filePath = $item->{$propertyName};

        if (!$filePath) {
            abort(404, 'No file path found');
        }

        $cleanPath = ltrim($filePath, '/');
        $storagePath = storage_path('app/private/' . $cleanPath);

        if (!File::exists($storagePath)) {
            abort(404, 'File not found on disk');
        }

        $size = File::size($storagePath);
        $mimeType = File::mimeType($storagePath);

        $stream = fopen($storagePath, 'rb');

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
        }, 200, [
            'Content-Type' => $mimeType,
            'Content-Length' => $size,
            'Content-Disposition' => 'inline',
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'no-cache, private',
        ]);
    }
}

