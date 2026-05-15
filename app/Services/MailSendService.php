<?php 

namespace App\Services;

use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class MailSendService {

    public static function sendMail(){
    Mail::send(new DefaultMail());

    }


}

