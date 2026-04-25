<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDefaultPermission();

        $admin = Role::create([

        'name' => 'super admin',
        'guard_name' => 'admin'
        ]);

        $reviewer = Role::create([
        'name' => 'reviewer',
        'guard_name' =>'admin',
        ]);
        $reviewer->givePermissionTo('review products');
    }

    function createDefaultPermission(): void {
        Permission::insert([[
        'name' => 'review products',
        'guard_name' =>'admin',
        'group_name'=> 'Review Product'
        ]]);

    }
}
