<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Exception;

class CategoryService
{
    public function store(array $data): Category
    {
        $data['file_types']       = $this->processFileTypes($data['file_types'] ?? null);
        $data['slug']             = Str::slug($data['name']);
        $data['show_at_nav']      = isset($data['show_at_nav']) ? 1 : 0;
        $data['show_at_featured'] = isset($data['show_at_featured']) ? 1 : 0;

        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        if (array_key_exists('file_types', $data)) {
            $data['file_types'] = $this->processFileTypes($data['file_types']);
        }

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if (array_key_exists('show_at_nav', $data)) {
            $data['show_at_nav'] = $data['show_at_nav'] ? 1 : 0;
        }

        if (array_key_exists('show_at_featured', $data)) {
            $data['show_at_featured'] = $data['show_at_featured'] ? 1 : 0;
        }

        $category->update($data);

        return $category;
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
