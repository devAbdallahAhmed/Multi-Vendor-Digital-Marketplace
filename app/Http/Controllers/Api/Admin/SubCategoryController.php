<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\subCategoryStoreRequest;
use App\Http\Requests\Admin\SubCategoryUpdateRequest;
use App\Http\Resources\Api\Admin\SubCategoryResource;
use App\Models\Admin\SubCategory;
use App\Services\Admin\SubCategoryService;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Exception;

class SubCategoryController extends Controller
{
    use ApiResponseTrait;

    protected $subCategory;

    function __construct(SubCategoryService $subCategory)
    {
        $this->subCategory = $subCategory;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_category = SubCategory::with('category')->latest()->paginate(10);
        return response()->json(['success' => true, 'message' => 'Sub categories retrieved successfully', 'data'  => SubCategoryResource::collection($sub_category)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(subCategoryStoreRequest $request)
    {
        try {
            $sub_category_store = $this->subCategory->store($request->validated());

            return $this->apiResponse(
                true,
                'Sub category created successfully',
                new SubCategoryResource($sub_category_store),
                21
            );
        } catch (Exception $e) {
            return $this->ApiResponse('false', 'Something went wrong ' . $e->getMessage(), null, 500);
        };
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
    public function update(SubCategoryUpdateRequest $request, $id)
    {
        try {
            $sub_category = $this->subCategory->updata($id, $request->validated());

            return $this->apiResponse(
                true,
                'Sub category updated successfully',
                new SubCategoryResource($sub_category),
                200
            );
        } catch (Exception $e) {
            return $this->apiResponse(false, 'Something went wrong: ' . $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        try {
            $sub_category->delete();
            return $this->ApiResponse(true, 'Sub Category Deleted Successfully');
        } catch (Exception $e) {
            return  $this->ApiResponse(false, 'Something want wrong' . $e->getMessage(), null, 500);
        };
    }
}
