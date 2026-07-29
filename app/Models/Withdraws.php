<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraws extends Model
{

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
