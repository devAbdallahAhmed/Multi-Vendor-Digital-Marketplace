<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Category;
use App\Models\Admin\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(3);
        $price = $this->faker->randomFloat(2, 10, 100);

        return [
            'author_id' => User::where('user_type', 'author')->inRandomOrder()->first()?->id ?? 1,
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'sub_category_id' => SubCategory::inRandomOrder()->first()?->id ?? 1,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'preview_type' => 'image',
            'preview_image' => 'defaults/video.webp',
            'main_file' => 'defaults/video.webp',
            'is_main_file_external' => 0, // أضفنا الحقل ده هنا عشان يحل مشكلة الـ Database
            'price' => $price,
            'discount_price' => $price - 10,
            'status' => 'active',
            'is_free' => 0,
        ];
    }
}
