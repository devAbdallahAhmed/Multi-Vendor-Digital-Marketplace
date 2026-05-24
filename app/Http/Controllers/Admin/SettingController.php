<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;

class SettingController extends Controller
{
    function index()
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(GeneralSettingRequest $request)
    {
        $validatedDate =  $request->validated();
        foreach ($validatedDate as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCacheSetting();
        NotificationService::updated();

        return redirect()->back();
    }
}
