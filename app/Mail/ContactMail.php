<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subjectLine;
    public $content;
    public $fromMail;
    public $toMail;

    public function __construct($name, $subjectLine, $content, $fromMail, $toMail)
    {
        $this->name = $name;
        $this->subjectLine = $subjectLine;
        $this->content = $content;
        $this->fromMail = $fromMail;
        $this->toMail = $toMail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->fromMail, $this->name),
            to: [$this->toMail],
            subject: $this->subjectLine,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-mail',
        );
    }
}