<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Qulint\Admin\Auth\Database\Menu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Dashboard menu item if it doesn't exist
        if (!Menu::where('title', 'Dashboard')->exists()) {
            Menu::create([
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Dashboard',
                'icon' => 'icon-dashboard',
                'uri' => '/',
                'permission' => null,
            ]);
        }
    }
}
