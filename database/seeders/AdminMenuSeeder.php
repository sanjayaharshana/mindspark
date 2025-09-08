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

        // Create Event Salary Management parent menu
        $eventSalaryMenu = Menu::firstOrCreate([
            'title' => 'Event Salary Management',
        ], [
            'parent_id' => 0,
            'order' => 1,
            'title' => 'Event Salary Management',
            'icon' => 'icon-calendar',
            'uri' => '',
            'permission' => null,
        ]);

        // Create Event Jobs menu item
        Menu::firstOrCreate([
            'title' => 'Event Jobs',
        ], [
            'parent_id' => $eventSalaryMenu->id,
            'order' => 0,
            'title' => 'Event Jobs',
            'icon' => 'icon-briefcase',
            'uri' => 'event-jobs',
            'permission' => null,
        ]);

        // Create Clients menu item
        Menu::firstOrCreate([
            'title' => 'Clients',
        ], [
            'parent_id' => $eventSalaryMenu->id,
            'order' => 1,
            'title' => 'Clients',
            'icon' => 'icon-building',
            'uri' => 'clients',
            'permission' => null,
        ]);

        // Create Promoters menu item
        Menu::firstOrCreate([
            'title' => 'Promoters',
        ], [
            'parent_id' => $eventSalaryMenu->id,
            'order' => 2,
            'title' => 'Promoters',
            'icon' => 'icon-users',
            'uri' => 'promoters',
            'permission' => null,
        ]);

        // Create Coordinators menu item
        Menu::firstOrCreate([
            'title' => 'Coordinators',
        ], [
            'parent_id' => $eventSalaryMenu->id,
            'order' => 3,
            'title' => 'Coordinators',
            'icon' => 'icon-user-tie',
            'uri' => 'coordinators',
            'permission' => null,
        ]);
    }
}
