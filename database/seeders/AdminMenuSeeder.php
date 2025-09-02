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

        // Create Campaign menu item if it doesn't exist
        if (!Menu::where('title', 'Campaigns')->exists()) {
            Menu::create([
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Campaigns',
                'icon' => 'icon-bullhorn',
                'uri' => 'campaigns',
                'permission' => null,
            ]);
        }

        // Create Customers menu item if it doesn't exist
        if (!Menu::where('title', 'Customers')->exists()) {
            Menu::create([
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Customers',
                'icon' => 'icon-users',
                'uri' => 'customers',
                'permission' => null,
            ]);
        }

        // Create Organizers menu item if it doesn't exist
        if (!Menu::where('title', 'Organizers')->exists()) {
            Menu::create([
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Organizers',
                'icon' => 'icon-user-tie',
                'uri' => 'organizers',
                'permission' => null,
            ]);
        }
    }
}
