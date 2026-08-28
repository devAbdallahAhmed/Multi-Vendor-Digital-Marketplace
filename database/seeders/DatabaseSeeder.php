<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Front\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Admin\RoleSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Item::factory(10)->create();
        $this->call([
            // RoleSeeder::class,
            // AdminSeeder::class,
            // UserSeeder::class,
            // CategorySeeder::class,
            // SubCategorySeeder::class,
        ]);
    }
}
