<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleUserService
{
    public function getAllUsersWithRoles($perPage = 10)
    {
        return Admin::with('roles')->paginate($perPage);
    }


    public function storeUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']);
            $admin = Admin::create($data);

            $role = Role::findById($data['role_id'], 'admin');
            $admin->assignRole($role);

            return $admin;
        });
    }

    public function updateUser(Admin $admin, array $data)
    {
        return DB::transaction(function () use ($admin, $data) {
            if (isset($data['password']) && $data['password'] !== null) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $admin->update($data);
            $admin->syncRoles([(int)$data['role_id']]);

            return $admin;
        });
    }

    public function deleteUser(Admin $admin)
    {
        if ($this->isSuperAdmin($admin)) {
            return false;
        }

        return DB::transaction(function () use ($admin) {
            $admin->syncRoles([]);
            return $admin->delete();
        });
    }

    public function isSuperAdmin(Admin $admin): bool
    {
        return $admin->hasRole('super admin');
    }
}
