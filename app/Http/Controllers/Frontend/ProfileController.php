<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use App\Traits\fileupload;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use App\Http\Requests\Front\PasswordRequest;
use App\Models\AuthorWithdrawInformation;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use  fileupload;
    public function index()
    {
        $user = Auth::user();
        $withdrawMethod = WithdrawMethod::whereStatus(1)->get();
        return view('frontend.dashboard.profile.index', compact('user', 'withdrawMethod'));
    }
    public function update(ProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $this->deleteFile($user->avatar);
            $avatarPath = $this->uploadFile($request->avatar, 'public');
            $data['avatar'] = $avatarPath;
        }
        $user->update($data);
        NotificationService::updated();

        return redirect()->back();
    }
    public function updatePassword(PasswordRequest  $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $user->update([
            'password' => bcrypt($data['password'])
        ]);
        NotificationService::updated();
        return redirect()->back();
    }

    public function storeWithdrawInfo(Request $request)
    {
        $request->validate([
            'withdraw_method_id' => ['required', 'exists:withdraw_methods,id'],
            'information' => ['required']
        ]);

        AuthorWithdrawInformation::updateOrCreate(
            ['author_id' => auth()->id()],
            [
                'withdraw_method_id' => $request->withdraw_method_id,
                'information' => $request->information
            ]
        );

        return redirect()->back();
    }
}
