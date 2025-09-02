<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Qulint\Admin\Auth\Database\Administrator;
use Qulint\Admin\Auth\Database\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // Create admin user if it doesn't exist
        $adminUser = Administrator::firstOrCreate([
            'username' => 'admin',
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('password'),
        ]);

        // Assign admin role to admin user
        $adminUser->roles()->sync([$adminRole->id]);
    }
}
