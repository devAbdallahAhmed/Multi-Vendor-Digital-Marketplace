<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon', 'slug', 'file_types', 'show_at_nav', 'show_at_featured'];

    protected $casts = [
        'file_types' => 'array',
    ];
}
