<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'label_1',
        'counter_1',
        'label_2',
        'counter_2',
        'label_3',
        'counter_3',
        'label_4',
        'counter_4'
    ];
}
