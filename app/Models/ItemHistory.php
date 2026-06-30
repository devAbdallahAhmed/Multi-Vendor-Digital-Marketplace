<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    protected $fillable = [
        'author_id',
        'item_id',
        'title',
        'body',
        'status',
        'reviewer_id'
    ];
}
