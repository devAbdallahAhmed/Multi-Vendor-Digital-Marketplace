<?php

namespace App\Services\Admin;

use App\Models\Admin\SubCategory as subCategoryModel;
use Illuminate\Support\Str;
use App\Models\Category;
use Exception;

class SubCategoryService
{

    function store(array  $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
            return subCategoryModel::create($data);
        }
    }

    public function updata($id, array $data)
    {
        $subCategory = subCategoryModel::findOrFail($id);

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $subCategory->update($data);

        return $subCategory;
    }
}
