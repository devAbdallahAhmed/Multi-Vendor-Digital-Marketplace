<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\KycStoreRequest;
use App\Http\Resources\Api\KycResource;
use App\Models\KycVerification;
use App\Services\KycService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class KycApiController extends Controller
{
    protected $kycService;
    public function __construct(KycService $kycService)
    {
        $this->kycService = $kycService;
    }

    public function submit(KycStoreRequest $request)
    {
        $kyc = $this->kycService->handleVerification($request->validated(), $request->file('documents'));

        return response()->json([
            'success' => 'true',
            'message' =>
            __('KYC verification documents uploaded successfully!'),
            'data' => new KycResource($kyc)
        ],);
    }

    public function status()
    {

        $kyc = KycVerification::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$kyc) {
            return response()->json([
                'success' => true,
                'status'  => 'not_submitted',
                'message' => __('No KYC application found. Please submit your documents.')
            ], Response::HTTP_OK);
        }

        return response()->json(['success' => 'true', 'status' => $kyc->status, 'reject_reason' => $kyc->reject_reason, 'data'          => new \App\Http\Resources\Api\KycResource($kyc)], Response::HTTP_OK);
    }

    function resubmit(KycStoreRequest $request)
    {
        $kyc = KycVerification::where('user_id', auth()->id())->latest()->first();

        if (!$kyc || $kyc->status !== 'rejected') {
            return response()->json([
                'success' => false,
                'message' => __('You cannot re-submit documents unless your application is rejected.')
            ], 400);
        }

        $updatedKyc = $this->kycService->handelResubmitKyc(
            kyc: $kyc,
            data: $request->validated(),
            files: $request->file('documents')
        );

        return response()->json([
            'success' => true,
            'message' => __('KYC documents re-submitted successfully!'),
            'data'    => new \App\Http\Resources\Api\KycResource($updatedKyc)
        ]);
    }
}
