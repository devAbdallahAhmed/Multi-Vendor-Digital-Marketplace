<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Frontend\ContactRequest;
use App\Services\MailSendService;
use App\Services\NotificationService;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.pages.contact', compact('settings'));
    }

    public function sendMail(ContactRequest $request)
    {
        $request->validated();
        $adminEmail = Setting::where('key', 'site_email')->value('value') ?? 'admin@yoursite.com';

        MailSendService::sendContactMail(
            name: $request->name,
            subjectLine: $request->subject,
            content: $request->message,
            fromMail: $request->email,
            toMail: $adminEmail
        );

        NotificationService::created('Mail sent successfully.');
        return redirect()->back();
    }
}
