<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\fileupload;
use App\Services\NotificationService;
use App\Http\Requests\Admin\Auth\PasswordRequest;

class ProfileController extends Controller
{
        use  fileupload;
    public function index(){
        $user = auth()->guard('admin')->user();
        return view('admin.dashboard.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $admin = auth()->guard('admin')->user();
        $data = $request->validated();
        if($request->hasFile('avatar')){
              $this->deleteFile($admin->avatar);
                $avatarPath= $this->uploadFile($request->avatar ,'uploads/admin/');
                $data['avatar'] = $avatarPath ;
        }
        $admin->update($data);
        NotificationService::updated();
        return redirect()->back();
    }

    public function updatePassword(PasswordRequest $request){
    $admin = auth('admin')->user();
    $admin->update([
        'password' => bcrypt($request->password)
    ]);
    NotificationService::updated();
    return redirect()->back();
   
    }
}
