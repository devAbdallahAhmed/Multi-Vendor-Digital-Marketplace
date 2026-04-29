<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Traits\fileupload;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    use fileupload;

    public function updateProfile(Admin $admin, array $data)
    {
      
        if (isset($data['avatar'])) {
            $this->deleteFile($admin->avatar);
            $data['avatar'] = $this->uploadFile($data['avatar'], 'uploads/admin/');
        }
        $admin->update($data);
        return $admin;
    }

    public function updatePassword(Admin $admin, string $newPassword)
    {
        return $admin->update([
            'password' => Hash::make($newPassword)
        ]);
    }
}