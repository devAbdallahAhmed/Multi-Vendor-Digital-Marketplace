<?php

namespace Database\Seeders\Front;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'  => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
