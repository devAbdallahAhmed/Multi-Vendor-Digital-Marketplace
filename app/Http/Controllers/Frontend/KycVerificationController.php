<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\KycVerificationRequest;
use App\Models\KycSetting;
use App\Services\KycService;
use App\Services\NotificationService;

class KycVerificationController extends Controller
{

    protected $kycService;

    public function __construct( KycService $kycService)
    {
        $this->kycService = $kycService;
    }

    public function index() {
        $kycSetting = KycSetting::query()->first();
        return view('frontend.pages.kyc', compact('kycSetting'));
    }

    public function store(KycVerificationRequest $request) {
        $this->kycService->handleVerification($request->validated(), $request->file('documents'));
        NotificationService::created('KYC submitted and verified by AI successfully!');
        return to_route('dashboard');
    }

}
