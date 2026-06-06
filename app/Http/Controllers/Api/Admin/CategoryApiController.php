<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\CategorystoreRequest;
use App\Http\Requests\Api\Admin\CategoryUpdateRequest;
use App\Http\Resources\Api\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryApiController extends Controller
{
    protected $categoryService;

    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return CategoryResource::collection($categories)
            ->additional([
                'success' => true,
                'message' => 'The Categories data retrieved successfully.'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorystoreRequest $request)
    {

        $category_store =  $this->categoryService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Created Category Successfully',
            'data' => new \App\Http\Resources\Api\CategoryResource($category_store),
            201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category_update = $this->categoryService->update($category, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Updated Category Successfully',
            'data' => new \App\Http\Resources\Api\CategoryResource($category_update),
            201
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->destroy($category);
        return response()->json(['success' => true, 'message' => 'Deleted Category Successfully']);
    }
}
