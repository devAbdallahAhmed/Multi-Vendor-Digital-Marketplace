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
    public $settingService;

    public  function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    function index()
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(GeneralSettingRequest $request)
    {
        $this->settingService->updateSettings($request->validated());
        NotificationService::updated();

        return redirect()->back();
    }


    function commissionSettings()
    {

        return view('admin.setting.pages.commission-setting');
    }

    function updateCommissionSetting(Request $request)
    {
        $validated  = $request->validate([
            'author_commission' => 'required|numeric'
        ]);

        $this->settingService->updateSettings($validated);

        NotificationService::updated();

        return redirect()->back();
    }
}
