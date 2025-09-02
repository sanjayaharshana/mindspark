<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promoter;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample promoters
        $promoters = [
            [
                'promoter_id' => 'PROM-20250902-1001',
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1-555-0101',
                'address' => '123 Main St, City, State 12345',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'emergency_contact' => 'Jane Smith',
                'emergency_phone' => '+1-555-0102',
                'bank_name' => 'First National Bank',
                'bank_account' => '1234567890',
                'tax_id' => '123-45-6789',
                'base_salary' => 2500.00,
                'status' => 'active',
                'join_date' => '2024-01-15',
                'notes' => 'Experienced promoter with excellent communication skills',
            ],
            [
                'promoter_id' => 'PROM-20250902-1002',
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1-555-0201',
                'address' => '456 Oak Ave, City, State 67890',
                'date_of_birth' => '1988-12-03',
                'gender' => 'female',
                'emergency_contact' => 'Mike Johnson',
                'emergency_phone' => '+1-555-0202',
                'bank_name' => 'City Bank',
                'bank_account' => '0987654321',
                'tax_id' => '987-65-4321',
                'base_salary' => 2300.00,
                'status' => 'active',
                'join_date' => '2024-02-20',
                'notes' => 'Great with customer interactions and product knowledge',
            ],
            [
                'promoter_id' => 'PROM-20250902-1003',
                'name' => 'David Wilson',
                'email' => 'david.wilson@example.com',
                'phone' => '+1-555-0301',
                'address' => '789 Pine St, City, State 11111',
                'date_of_birth' => '1992-08-22',
                'gender' => 'male',
                'emergency_contact' => 'Lisa Wilson',
                'emergency_phone' => '+1-555-0302',
                'bank_name' => 'Regional Bank',
                'bank_account' => '1122334455',
                'tax_id' => '456-78-9012',
                'base_salary' => 2400.00,
                'status' => 'active',
                'join_date' => '2024-03-10',
                'notes' => 'Strong sales background and team player',
            ],
            [
                'promoter_id' => 'PROM-20250902-1004',
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'phone' => '+1-555-0401',
                'address' => '321 Elm St, City, State 22222',
                'date_of_birth' => '1995-03-14',
                'gender' => 'female',
                'emergency_contact' => 'Robert Davis',
                'emergency_phone' => '+1-555-0402',
                'bank_name' => 'Community Bank',
                'bank_account' => '5566778899',
                'tax_id' => '789-01-2345',
                'base_salary' => 2200.00,
                'status' => 'inactive',
                'join_date' => '2024-04-05',
                'notes' => 'On temporary leave due to personal reasons',
            ],
            [
                'promoter_id' => 'PROM-20250902-1005',
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '+1-555-0501',
                'address' => '654 Maple Dr, City, State 33333',
                'date_of_birth' => '1987-11-08',
                'gender' => 'male',
                'emergency_contact' => 'Patricia Brown',
                'emergency_phone' => '+1-555-0502',
                'bank_name' => 'Metro Bank',
                'bank_account' => '9988776655',
                'tax_id' => '321-54-6789',
                'base_salary' => 2600.00,
                'status' => 'active',
                'join_date' => '2024-01-08',
                'notes' => 'Senior promoter with leadership qualities',
            ],
        ];

        foreach ($promoters as $promoterData) {
            Promoter::firstOrCreate(
                ['email' => $promoterData['email']],
                $promoterData
            );
        }
    }
}
