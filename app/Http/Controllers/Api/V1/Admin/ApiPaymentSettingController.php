<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PayPalSettingUpdateRequest;
use App\Http\Requests\Admin\StripeSettingUpdateRequest;
use App\Services\SettingService;
use App\Traits\ApiResponseTrait;

class ApiPaymentSettingController extends Controller
{
    use ApiResponseTrait;

    public function updatePaypalSetting(PayPalSettingUpdateRequest $request, SettingService $settingService)
    {
        $settingService->updateSettings($request->validated());

        return $this->successResponse(null, 'PayPal settings updated successfully.');
    }

    public function updateStripeSetting(StripeSettingUpdateRequest $request, SettingService $settingService)
    {
        $settingService->updateSettings($request->validated());

        return $this->successResponse(null, 'Stripe settings updated successfully.');
    }
}
