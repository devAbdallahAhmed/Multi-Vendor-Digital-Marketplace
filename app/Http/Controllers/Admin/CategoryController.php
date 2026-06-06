<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Services\Admin\CategoryService;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    static function middleware(): array{
        return [
            new Middleware('permission:manage category'),
        ];
    }

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        $this->categoryService->store($request->validated());

        NotificationService::created();
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        if (is_array($category->file_types)) {
            $category->file_types = implode(',', $category->file_types);
        }
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        NotificationService::updated();
        return redirect()->route('admin.categories.index');
    }
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->destroy($category);
            NotificationService::deleted();
            return redirect()->route('admin.categories.index');
        } catch (Exception $e) {
            NotificationService::error('This category contains sub-categories and cannot be deleted!');
            return redirect()->back();
        }
    }
}
