<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $fillable = ['name', 'maximum_amount', 'minimum_amount', 'status', 'description'];
    

}
