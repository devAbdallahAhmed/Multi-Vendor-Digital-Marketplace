<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public function setSetting()
    {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        config()->set('settings', $settings);
    }
    public function updateSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->clearCacheSetting();
    }

    public function clearCacheSetting()
    {
        Cache::forget('settings');
    }
}
