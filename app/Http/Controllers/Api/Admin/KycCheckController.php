<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\KycStatusService;
use App\Http\Resources\Api\KycResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class KycCheckController extends Controller
{
    public function index()
    {
        $kycVerification = KycVerification::with('user')
            ->latest()
            ->paginate(25);

        return KycResource::collection($kycVerification);
    }

    public function show(KycVerification $kyc)
    {
        return new KycResource($kyc->load('user'));
    }

    public function destroy(KycVerification $kyc): JsonResponse
    {
        $kyc->delete();

        return response()->json([
            'success' => true,
            'message' => __('KYC Request Deleted Successfully')
        ], Response::HTTP_OK);
    }

    public function downloadDocument(KycVerification $kyc, int $index)
    {
        $attachments = $kyc->documents;

        if (!isset($attachments[$index])) {
            return response()->json(['success' => false, 'message' => __('Document not found in record.')], 404);
        }

        $attachmentPath = $attachments[$index];

        if (!Storage::disk('local')->exists($attachmentPath)) {
            return response()->json(['success' => false, 'message' => __('File missing from storage.')], 404);
        }

        $fullPath = Storage::disk('local')->path($attachmentPath);

        return response()->file($fullPath);
    }

    public function updateStatus(Request $request, KycVerification $kyc): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'reject_reason' => 'required_if:status,rejected|string|max:500'
        ]);

        KycStatusService::updateStatus(
            kyc: $kyc,
            status: $validated['status'],
            reason: $validated['reject_reason'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => __('KYC status updated successfully!')
        ], Response::HTTP_OK);
    }
}
