<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyPickedProduct extends Model
{
    protected $fillable = [

        'title',
        'content',
        'item_ids'
    ];

    protected function casts(): array
    {
        return [
            'item_ids' => 'array',
        ];
    }
}
