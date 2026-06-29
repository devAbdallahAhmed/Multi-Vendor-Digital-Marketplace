<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemChangelog extends Model
{
    protected $table = 'item_change_logs';
    protected $fillable = ['item_id', 'version', 'description'];
}
