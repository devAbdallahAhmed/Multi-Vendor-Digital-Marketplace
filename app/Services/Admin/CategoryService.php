<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Exception;

class CategoryService
{

    public function store(array $data): Category
    {
        $data['file_types'] = $this->processFileTypes($data['file_types'] ?? null);
        $data['slug'] = Str::slug($data['name']);
        $data['show_at_nav'] = request()->has('show_at_nav') ? 1 : 0;
        $data['show_at_featured'] = request()->has('show_at_featured') ? 1 : 0;

        return Category::create($data);
    }


    public function update(Category $category, array $data): bool
    {
        $data['file_types'] = $this->processFileTypes($data['file_types'] ?? null);
        $data['slug'] = Str::slug($data['name']);
        $data['show_at_nav'] = request()->has('show_at_nav') ? 1 : 0;
        $data['show_at_featured'] = request()->has('show_at_featured') ? 1 : 0;
        return $category->update($data);
    }


    private function processFileTypes(?string $fileTypesJson): array
    {
        if (!$fileTypesJson) {
            return [];
        }

        $tags = json_decode($fileTypesJson, true);

        return collect($tags)->pluck('value')->toArray();
    }



    public function destroy(Category $category): bool
    {
        if ($category->subCategories()->exists()) {
            throw new Exception(__('This category contains sub-categories and cannot be deleted!'));
        }
        return $category->delete();
    }
}
