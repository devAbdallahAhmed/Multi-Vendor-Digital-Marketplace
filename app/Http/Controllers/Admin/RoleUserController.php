<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Admin\RoleUserService;
use App\Services\NotificationService;
use App\Http\Requests\Admin\RoleUserCreateRequest;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    protected $roleUserService;

    public function __construct(RoleUserService $roleUserService)
    {
        $this->roleUserService = $roleUserService;
    }

    public function index()
    {
        $users = $this->roleUserService->getAllUsersWithRoles();
        return view('admin.access-management.roles-user.index', compact('users'));
    }

    public function store(RoleUserCreateRequest $request)
    {
        $this->roleUserService->storeUser($request->validated());
        NotificationService::created('Role User Created Successfully');
        return redirect()->route('admin.role-users.index');
    }

    public function edit(Admin $role_user)
    {
        if ($this->roleUserService->isSuperAdmin($role_user)) {
            NotificationService::error('Cannot edit Super Admin');
            return to_route('admin.role-users.index');
        }

        $roles = Role::all();
        return view('admin.access-management.roles-user.edit', [
            'admin' => $role_user->load('roles'),
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRoleRequest $request, Admin $role_user)
    {
        if ($this->roleUserService->isSuperAdmin($role_user)) {
            NotificationService::error('Cannot update Super Admin');
            return to_route('admin.role-users.index');
        }

        $this->roleUserService->updateUser($role_user, $request->validated());
        NotificationService::updated('Role User Updated Successfully');
        return redirect()->route('admin.role-users.index');
    }

    public function destroy(Admin $role_user)
    {
        if (!$this->roleUserService->deleteUser($role_user)) {
            NotificationService::error('Cannot delete Super Admin');
            return to_route('admin.role-users.index');
        }

        NotificationService::deleted('Role User Deleted Successfully');
        return redirect()->route('admin.role-users.index');
    }
}
