<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycVerification extends Model
{
    protected $guarded = [];

    protected $casts = [
    'documents' => 'array',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
