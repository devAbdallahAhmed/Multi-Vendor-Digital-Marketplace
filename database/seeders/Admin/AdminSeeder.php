<?php

namespace Database\Seeders\Admin;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =  Admin::create([
        'name'=> ' Super Admin',
        'email' =>'admin@gmail.com',
        'country' => 'Egypt',
        'city' => 'Cairo',
        'address' => '123 Main Street, Cairo, Egypt',
        'password'=>  Hash::make('12345678'),
        ]);
        $admin->assignRole('super admin');

        $reviewer = Admin::create([
             'name'=> 'Reviewer',
        'email' =>'reviewer@gmail.com',
        'country' => 'Egypt',
        'city' => 'Cairo',
        'address' => '123 Main Street, Cairo, Egypt',
        'password'=>  Hash::make('12345678'),
        ]);
        $reviewer->assignRole('reviewer');
   }
}
