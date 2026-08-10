<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge',
        'title',
        'subtitle',
        'trending_tags'
    ];

    protected $casts = [
        'trending_tags' => 'array',
    ];
}
