<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customers;
use App\Models\Organizer;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample customers
        $customers = [
            [
                'name' => 'ABC Corporation',
                'email' => 'contact@abccorp.com',
                'phone' => '+1-555-0123',
                'address' => '123 Business St, City, State 12345',
                'notes' => 'Major retail client',
                'is_company' => true,
                'coordinators' => 'John Smith, Jane Doe',
                'company' => 'ABC Corporation',
                'status' => 'active',
            ],
            [
                'name' => 'XYZ Enterprises',
                'email' => 'info@xyzenterprises.com',
                'phone' => '+1-555-0456',
                'address' => '456 Corporate Ave, City, State 67890',
                'notes' => 'Technology company',
                'is_company' => true,
                'coordinators' => 'Mike Johnson',
                'company' => 'XYZ Enterprises',
                'status' => 'active',
            ],
            [
                'name' => 'Local Restaurant',
                'email' => 'manager@localrestaurant.com',
                'phone' => '+1-555-0789',
                'address' => '789 Main St, City, State 11111',
                'notes' => 'Local business',
                'is_company' => false,
                'coordinators' => 'Sarah Wilson',
                'company' => 'Local Restaurant',
                'status' => 'active',
            ],
        ];

        foreach ($customers as $customerData) {
            Customers::firstOrCreate(
                ['email' => $customerData['email']],
                $customerData
            );
        }

        // Create sample organizers
        $organizers = [
            [
                'name' => 'Marketing Pro Agency',
                'email' => 'contact@marketingpro.com',
                'phone' => '+1-555-0100',
                'company' => 'Marketing Pro Agency',
                'position' => 'Campaign Manager',
                'status' => 'active',
            ],
            [
                'name' => 'Event Solutions Inc',
                'email' => 'info@eventsolutions.com',
                'phone' => '+1-555-0200',
                'company' => 'Event Solutions Inc',
                'position' => 'Senior Organizer',
                'status' => 'active',
            ],
            [
                'name' => 'Promo Masters',
                'email' => 'team@promomasters.com',
                'phone' => '+1-555-0300',
                'company' => 'Promo Masters',
                'position' => 'Lead Coordinator',
                'status' => 'active',
            ],
        ];

        foreach ($organizers as $organizerData) {
            Organizer::firstOrCreate(
                ['email' => $organizerData['email']],
                $organizerData
            );
        }
    }
}
