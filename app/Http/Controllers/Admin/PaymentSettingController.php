<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PayPalSettingUpdateRequest;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    function index()
    {
        return view('admin.payment-setting.pages.paypal-setting');
    }

    function updatePaypalSetting(PayPalSettingUpdateRequest $request)
    {

        $validated = $request->validated();

        foreach ($validated as $key => $value) {

            Setting::UpdateOrCreate([
                'key' => $key,
                'value' => $value
            ]);
        }
        $service = app()->make(SettingService::class);
        $service->clearCacheSetting();
        NotificationService::updated();
        return redirect()->back();
    }
}
