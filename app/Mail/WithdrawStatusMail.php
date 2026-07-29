<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Withdraws;

class WithdrawStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $withdraw;
    public $amountFormatted;

    public function __construct(Withdraws $withdraw)
    {
        $this->withdraw = $withdraw;
        $this->amountFormatted = currencyPosition($withdraw->amount);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->withdraw->status === 'paid' ? 'Withdrawal Request Approved' : 'Withdrawal Request Rejected';
        return new Envelope(
            subject: $subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->withdraw->status === 'paid' ?  'emails.withdraw.approved'
            : 'emails.withdraw.rejected';
        return new Content(
            view: $view,
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
