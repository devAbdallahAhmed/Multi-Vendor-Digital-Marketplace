<?php

namespace App\Services;

use App\Mail\DefaultMail;
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
}
