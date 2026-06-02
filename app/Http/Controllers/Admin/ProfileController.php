<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\fileupload;
use App\Services\NotificationService;
use App\Http\Requests\Admin\Auth\PasswordRequest;
use App\Services\Admin\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $user = auth()->guard('admin')->user();
        return view('admin.dashboard.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $admin = auth()->guard('admin')->user();
        $this->profileService->updateProfile($admin, $request->validated());
        NotificationService::updated();
        return redirect()->back();
    }

    public function updatePassword(PasswordRequest $request)
    {
        $admin = auth('admin')->user();
        $this->profileService->updatePassword($admin, $request->validated());
        NotificationService::updated();
        return redirect()->back();
    }
}
