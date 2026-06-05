<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\subCategoryStoreRequest;
use App\Http\Requests\Admin\SubCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Admin\SubCategoryService;
use App\Services\NotificationService;
use App\Models\Admin\SubCategory as AdminSubCategory;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Routing\Controllers\HasMiddleware;

class SubCategory extends Controller implements HasMiddleware
{

    protected $subCategoryService;
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }


    static function middleware(): array
    {
        return [
            new Middleware('permission:manage category'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = AdminSubCategory::with('category')->latest()->paginate(10);
        return view('admin.category.sub-category.index', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.category.sub-category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(subCategoryStoreRequest $request)
    {
        $this->subCategoryService->store($request->validated());

        NotificationService::created();
        return redirect()->route('admin.sub-categories.index');
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
    public function edit(AdminSubCategory $sub_category)
    {
        $category = Category::all();
        return view('admin.category.sub-category.edit', compact('sub_category', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request,  AdminSubCategory $sub_category)
    {
        $this->subCategoryService->updata($sub_category, $request->validated());
        NotificationService::updated();
        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminSubCategory $sub_category)
    {
        $sub_category->delete();
        NotificationService::deleted();
        return redirect()->route('admin.sub-categories.index');
    }
}
