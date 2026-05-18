<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $mailSubject;
    public $content;
    public $toMail;

    public function __construct($name, $mailSubject, $content, $toMail)
    {
        $this->name = $name;
        $this->mailSubject = $mailSubject;
        $this->content = $content;
        $this->toMail = $toMail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.default-mail',
            with: [
                'name' => $this->name,
                'subject' => $this->mailSubject,
                'content' => $this->content,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
