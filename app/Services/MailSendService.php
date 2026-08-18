<?php

namespace App\Services;

use App\Mail\DefaultMail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class MailSendService
{
    public static function sendMail(string $name, string $mailSubject, string $toMail, string $content)
    {
        Mail::to($toMail)->queue(
            new DefaultMail(
                name: $name,
                mailSubject: $mailSubject,
                content: $content,
                toMail: $toMail
            )
        );
    }

    public static function sendContactMail(string $name, string $subjectLine, string $content, string $fromMail, string $toMail)
    {
        Mail::to($toMail)->queue(
            new ContactMail(
                name: $name,
                subjectLine: $subjectLine,
                content: $content,
                fromMail: $fromMail,
                toMail: $toMail
            )
        );
    }
}
