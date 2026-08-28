<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Code & Scripts',
            'Website Themes & Templates',
            'Graphics & Design',
            'Video & Motion Graphics',
            'Audio & Music',
            'eBooks & Learning Materials',
            'Presentation Templates',
            'Photography',
            'Marketing & Business Tools',
            'Plugins & Extensions'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'icon' => 'fas fa-folder',
                'show_at_featured' => 1,
            ]);
        }
    }
}
