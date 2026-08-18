<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    protected $fillable = [
        'id',
        'description',
        'item_sold',
        'community_earnings',
        'copyright'
    ];
}
