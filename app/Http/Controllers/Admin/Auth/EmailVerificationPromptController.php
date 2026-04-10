<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
public function __invoke(Request $request): RedirectResponse|View
{
    $user = Auth::guard('admin')->user();


    return $user->hasVerifiedEmail()
        ? redirect()->intended(route('admin.dashboard'))
        : view('admin.auth.verify-email');
}
}
