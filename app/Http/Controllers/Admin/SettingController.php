<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use App\Traits\FileUpload;

class SettingController extends Controller
{
    use FileUpload;

    public $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        return view('admin.setting.index');
    }

    public function updateGeneralSetting(GeneralSettingRequest $request)
    {
        $this->settingService->updateSettings($request->validated());

        NotificationService::updated();

        return redirect()->back();
    }

    public function commissionSettings()
    {
        return view('admin.setting.pages.commission-setting');
    }

    public function updateCommissionSetting(Request $request)
    {
        $validated = $request->validate([
            'author_commission' => 'required|numeric'
        ]);

        $this->settingService->updateSettings($validated);

        NotificationService::updated();

        return redirect()->back();
    }

    public function logoSetting()
    {
         $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.setting.pages.logo-setting' , compact('settings'));
    }

    public function updateLogoSetting(Request $request)
    {
        $request->validate([
            'logo'        => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
            'favicon'     => 'nullable|image|max:2048',
            'breadcrumb'  => 'nullable|image|max:2048',
        ]);

        $settingsData = [];
        $currentSettings = Setting::pluck('value', 'key')->toArray();

        $imageKeys = ['logo', 'footer_logo', 'favicon', 'breadcrumb'];

        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                if (!empty($currentSettings[$key])) {
                    $this->deleteFile($currentSettings[$key], 'public');
                }
                $settingsData[$key] = $this->uploadFile($request->file($key), 'public', 'uploads/settings');
            }
        }

        if (!empty($settingsData)) {
            $this->settingService->updateSettings($settingsData);
        }

        NotificationService::updated();

        return redirect()->back();
    }


    public function smtpSetting()
    {
        return view('admin.setting.pages.smtp-setting');
    }

    public function updateSmtpSetting(Request $request)
    {
        $validated = $request->validate([
            'smtp_sender_name'     => 'required|string|max:255',
            'smtp_sender_email'    => 'required|email|max:255',
            'smtp_recipient_email' => 'required|email|max:255',
            'smtp_host'            => 'required|string|max:255',
            'smtp_username'        => 'required|string|max:255',
            'smtp_password'        => 'required|string|max:255',
            'smtp_port'            => 'required|numeric',
            'smtp_encryption'      => 'required|in:ssl,tls',
        ]);

        $this->settingService->updateSettings($validated);

        NotificationService::updated();

        return redirect()->back();
    }
}
