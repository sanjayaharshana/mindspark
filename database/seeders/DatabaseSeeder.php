<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create test user only if it doesn't exist
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed admin menu items
        $this->call([
            AdminUserSeeder::class,
            AdminMenuSeeder::class,
            ClientSeeder::class,
            EventJobSeeder::class,
            CoordinatorSeeder::class,
            PromoterSeeder::class,
            PromoterEventJobSeeder::class,
        ]);
    }
}
