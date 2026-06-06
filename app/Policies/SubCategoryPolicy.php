<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;

class SubCategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function before(Admin $admin, $ability)
    {
        if ($admin->hasRole('super admin')) {
            return true;
        }
    }

    public function viewAny(Admin $admin): bool
    {
        return $admin->hasPermissionTo('categories.index');
    }

    public function create(Admin $admin): bool
    {
        return $admin->hasPermissionTo('categories.create');
    }

    public function update(Admin $admin): bool
    {
        return $admin->hasPermissionTo('categories.edit');
    }

    public function delete(Admin $admin): bool
    {
        return $admin->hasPermissionTo('categories.delete');
    }
}
