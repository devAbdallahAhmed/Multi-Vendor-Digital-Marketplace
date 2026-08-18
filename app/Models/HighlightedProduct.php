<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighlightedProduct extends Model
{
    protected $fillable = [ 'title', 'subtitle', 'item_ids'];

    protected function casts(): array
    {
        return [
            'item_ids' => 'array',
        ];
    }
}
