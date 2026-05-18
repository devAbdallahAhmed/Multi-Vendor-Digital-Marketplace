<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Services\MailSendService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\KycStatusService;
use Illuminate\Support\Facades\Redirect;

class KycCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kycVerification = KycVerification::with('user')
            ->latest()->paginate(25);
        return view('admin.kyc.kyc-request.index', compact('kycVerification'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Display the specified resource.
     */
    public function show(KycVerification $kyc)
    {
        $attachments = $kyc->documents;

        return view('admin.kyc.kyc-request.show', compact('kyc', 'attachments'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KycVerification $kyc)
    {
        $kyc->delete();

        NotificationService::deleted('Request Deleted Successfully');
        return to_route('admin.kyc-request.index');
    }

    public function downloadDocument(KycVerification $kyc, int $index)
    {
        $attachments = $kyc->documents;

        if (!isset($attachments[$index])) {
            abort(404, 'Document not found in record.');
        }

        $attachmentPath = $attachments[$index];

        if (!Storage::disk('local')->exists($attachmentPath)) {
            abort(404, 'File missing from storage.');
        }

        return response()->file(storage_path('app/private/' . $attachmentPath));
    }


    public function updateStatus(Request $request, KycVerification $kyc)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'reason' => 'nullable|string|max:500'
        ]);
        KycStatusService::updateStatus(
            kyc: $kyc,
            status: $validated['status'],
            reason: $validated['reason'] ?? null
        );


        NotificationService::updated();
        return response()->json([
            'success' => true,
            'message' => __('KYC status updated successfully!')
        ]);
    }
}
