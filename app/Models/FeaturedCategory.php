<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedCategory extends Model
{
    protected $fillable = ['id' , 'category_ids'];

    protected $casts = ['category_ids' => 'array'];
}
