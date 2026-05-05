<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycSetting extends Model
{
    /** @use HasFactory<\Database\Factories\KycSettingFactory> */
    use HasFactory;
   protected $fillable = ['id', 'nid_verifications', 'passport_verifications', 'instructions', 'auto_approve', 'status'];
}
