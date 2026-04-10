<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use App\Traits\fileupload;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use App\Http\Requests\Front\PasswordRequest;

class ProfileController extends Controller
{
    use  fileupload;
    public function index(){
        $user = Auth::user();
        return view('frontend.dashboard.profile.index', compact('user'));
    }
    public function update( ProfileRequest $request) :RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        if($request->hasFile('avatar')){
           $this->deleteFile($user->avatar);
            $avatarPath= $this->uploadFile($request->avatar);
            $data['avatar'] = $avatarPath ;
        }
        $user->update($data);
        NotificationService::updated();

        return redirect()->back();
    }
    public function updatePassword(PasswordRequest  $request){
        $user = Auth::user();
        $data = $request->validated();
        $user->update([
            'password' => bcrypt($data['password'])
        ]);
        NotificationService::updated();
        return redirect()->back();
    }
}
