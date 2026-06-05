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
        $data['slug'] = Str::slug($data['name']);
        return subCategoryModel::create($data);
    }

    function updata(subCategoryModel $subCategory, array  $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $subCategory->update($data);
    }

}
