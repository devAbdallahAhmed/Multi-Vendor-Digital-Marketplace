<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorSale extends Model
{
    protected $fillable = [
        'author_id',
        'user_id',
        'item_id',
        'amount',
        'author_commission_rate',
        'author_earning'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
