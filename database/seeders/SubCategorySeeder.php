<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $subCategories = [
            'Video & Motion Graphics' => [
                'Stock Footage', 'Motion Graphics', 'After Effects Templates'
            ],
            'Audio & Music' => [
                'Royalty-Free Music', 'Sound Effects', 'Beats & Background Music'
            ],
            'Code & Scripts' => [
                'PHP Scripts', 'JavaScript', 'Mobile Apps'
            ],
            'Website Themes & Templates' => [
                'WordPress', 'HTML5', 'Admin Templates'
            ]
        ];

        foreach ($subCategories as $categoryName => $subs) {
            $category = Category::where('name', $categoryName)->first();

            if ($category) {
                foreach ($subs as $sub) {
                    SubCategory::create([
                        'category_id' => $category->id,
                        'name' => $sub,
                        'slug' => Str::slug($sub),
                    ]);
                }
            }
        }
    }
}




