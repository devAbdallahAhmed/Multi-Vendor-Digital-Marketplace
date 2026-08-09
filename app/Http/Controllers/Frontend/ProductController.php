<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $itemService;

    public function __construct(ProductService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        $data = $this->itemService->getProductsPageData($request->all());

        return view('frontend.pages.products', $data);
    }

    public function show($slug)
    {
        $data = $this->itemService->getProductDetailsPageData($slug);

        return view('frontend.pages.product-details', $data);
    }

    public function streamPreview(string $id)
    {
        return $this->itemService->getStreamPreviewResponse($id);
    }
}
