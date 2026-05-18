<?php

namespace App\Services;

use App\Models\KycVerification;
use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class KycStatusService
{
    public static function updateStatus(KycVerification $kyc, string $status, ?string $reason = null): void
    {
        if ($status === 'approved') {
            $kyc->update([
                'status' => 'approved',
                'reject_reason' => null
            ]);

            $kyc->user->update([
                'user_type' => 'author'
            ]);

            Mail::to($kyc->user->email)->queue(
                new DefaultMail(
                    name: $kyc->user->name,
                    mailSubject: __('Your KYC Verification Approved!'),
                    toMail: $kyc->user->email,
                    content: __('Congratulations! Your KYC verification request has been approved. You are now an author.')
                )
            );
        } elseif ($status === 'rejected') {
            $kyc->update([
                'status' => 'rejected',
                'reject_reason' => $reason
            ]);

            Mail::to($kyc->user->email)->queue(
                new DefaultMail(
                    name: $kyc->user->name,
                    mailSubject: __('Your KYC Verification Rejected'),
                    toMail: $kyc->user->email,
                    content: __('We are sorry to inform you that your KYC verification request has been rejected. Reason: ') . $reason
                )
            );
        }
    }
}
