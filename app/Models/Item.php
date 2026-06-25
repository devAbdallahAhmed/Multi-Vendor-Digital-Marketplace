<?php

namespace App\Models;

use App\Models\Admin\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Override;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Item extends Model
{

    //
    use HasFactory,
        HasSlug;


    protected $fillable = [
        'author_id',
        'name',
        'slug',
        'description',
        'category_id',
        'sub_category_id',
        'options',
        'version',
        'demo_link',
        'tags',
        'thumbnail',
        'preview_type',
        'preview_image',
        'preview_video',
        'preview_audio',
        'main_file',
        'is_main_file_external',
        'screenshots',
        'price',
        'discount_price',
        'is_supported',
        'support_instruction'
    ];

    function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    protected $casts = [
        'tags' => 'array',
        'screenshots' => 'array',
    ];


    function user()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
