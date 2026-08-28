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
            'guard_name' => 'admin',
        ]);
        $reviewer->givePermissionTo('review products');
    }

    function createDefaultPermission(): void
    {
        Permission::insert([

            array('id' => '1', 'name' => 'review products', 'guard_name' => 'admin', 'group_name' => 'Review Product', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '2', 'name' => 'manage order', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:06:58', 'updated_at' => '2026-08-19 05:06:58'),
            array('id' => '3', 'name' => 'manage KYC', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:00', 'updated_at' => '2026-08-19 05:07:00'),
            array('id' => '4', 'name' => 'manage withdraw request', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:02', 'updated_at' => '2026-08-19 05:07:02'),
            array('id' => '5', 'name' => 'manage withdraw method', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:03', 'updated_at' => '2026-08-19 05:07:03'),
            array('id' => '6', 'name' => 'manage section', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:05', 'updated_at' => '2026-08-19 05:07:05'),
            array('id' => '7', 'name' => 'manage socials', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:06', 'updated_at' => '2026-08-19 05:07:06'),
            array('id' => '8', 'name' => 'manage banner', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:07', 'updated_at' => '2026-08-19 05:07:07'),
            array('id' => '9', 'name' => 'page builder', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:09', 'updated_at' => '2026-08-19 05:07:09'),
            array('id' => '10', 'name' => 'manage newsletter', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:10', 'updated_at' => '2026-08-19 05:07:10'),
            array('id' => '11', 'name' => 'access management', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:11', 'updated_at' => '2026-08-19 05:07:11'),
            array('id' => '12', 'name' => 'payment setting', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:13', 'updated_at' => '2026-08-19 05:07:13'),
            array('id' => '13', 'name' => 'manage settings', 'guard_name' => 'admin', 'group_name' => NULL, 'created_at' => '2026-08-19 05:07:15', 'updated_at' => '2026-08-19 05:07:15')
        ]);
    }
}
