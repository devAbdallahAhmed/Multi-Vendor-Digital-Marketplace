<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    function setSetting()
    {
        $setting = $this->getSettings();
        config()->set('settings', $setting);
    }

    public function clearCacheSetting()
    {
        Cache::forget('settings');
    }
}
