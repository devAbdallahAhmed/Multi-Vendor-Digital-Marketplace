<?php

namespace App\Listeners;

use App\Events\WithdrawProcessed;
use App\Mail\DefaultMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWithdrawNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(WithdrawProcessed $event): void
    {
        $withdraw = $event->withdraws;
        $author = $withdraw->author;

        $name = $author->name;
        $toMail = $author->email;
        $amountFormatted = currencyPosition($withdraw->amount);

        if ($withdraw->status === 'paid') {
            $mailSubject = __('Withdrawal Request Approved');
            $content = __('Your withdrawal request for :amount has been approved and processed successfully.', ['amount' => $amountFormatted]);
        } else {
            $mailSubject = __('Withdrawal Request Rejected');
            $content = __('Your withdrawal request for :amount has been rejected. Please try again or contact support.', ['amount' => $amountFormatted]);
        }

        Mail::to($toMail)->send(new DefaultMail($name, $mailSubject, $content, $toMail));
    }
}
