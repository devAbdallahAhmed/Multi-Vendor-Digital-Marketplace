<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedAuthorSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
