<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSection extends Model
{
    protected $fillable = [
        'banner_image_1',
        'banner_title_1',
        'banner_subtitle_1',
        'button_text_1',
        'button_url_1',
        'banner_image_2',
        'banner_title_2',
        'banner_subtitle_2',
        'button_text_2',
        'button_url_2'
    ];
}
