<?php

namespace App\Listeners;

use App\Events\ItemStatusUpdated;
use App\Services\MailSendService;
use Illuminate\Contracts\Queue\ShouldQueue;
class SendItemStatusEmail implements ShouldQueue
{
    protected MailSendService $mailSenderService;

    public function __construct(MailSendService $mailSenderService)
    {
        $this->mailSenderService = $mailSenderService;
    }

    public function handle(ItemStatusUpdated $event): void
    {
        $title = match ($event->status) {
            'approved'    => 'Item Approved',
            'soft_reject' => 'Item Soft Rejected',
            'hard_reject' => 'Item Hard Rejected',
            default       => 'Status Reset to Pending',
        };

        $body = match ($event->status) {
            'approved' => 'Congratulations! Your item has been approved and is now active.',
            default    => $event->reason,
        };

        $this->mailSenderService->sendMail(
            name: $event->item->author->name ?? 'Author',
            mailSubject: $title . ' | ' . $event->item->name,
            content: $body,
            toMail: $event->item->author->email
        );
    }
}
