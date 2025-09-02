<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample supervisors
        $supervisors = [
            [
                'supervisor_id' => 'SUP-20250902-2001',
                'name' => 'Robert Anderson',
                'email' => 'robert.anderson@example.com',
                'phone' => '+1-555-1001',
                'address' => '123 Executive Blvd, City, State 12345',
                'date_of_birth' => '1980-03-15',
                'gender' => 'male',
                'emergency_contact' => 'Mary Anderson',
                'emergency_phone' => '+1-555-1002',
                'department' => 'Sales',
                'position' => 'Sales Manager',
                'employee_id' => 'EMP001',
                'bank_name' => 'First National Bank',
                'bank_account' => '1111222233',
                'tax_id' => '111-22-3333',
                'base_salary' => 4500.00,
                'bonus_percentage' => 15.00,
                'status' => 'active',
                'join_date' => '2020-01-15',
                'promotion_date' => '2022-06-01',
                'team_size' => 8,
                'responsibilities' => 'Manage sales team, set targets, monitor performance, conduct training sessions',
                'notes' => 'Excellent leadership skills and strong sales background',
            ],
            [
                'supervisor_id' => 'SUP-20250902-2002',
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@example.com',
                'phone' => '+1-555-2001',
                'address' => '456 Management Ave, City, State 67890',
                'date_of_birth' => '1985-07-22',
                'gender' => 'female',
                'emergency_contact' => 'Carlos Martinez',
                'emergency_phone' => '+1-555-2002',
                'department' => 'Marketing',
                'position' => 'Marketing Director',
                'employee_id' => 'EMP002',
                'bank_name' => 'City Bank',
                'bank_account' => '4444555566',
                'tax_id' => '444-55-6666',
                'base_salary' => 5200.00,
                'bonus_percentage' => 20.00,
                'status' => 'active',
                'join_date' => '2019-03-20',
                'promotion_date' => '2021-09-15',
                'team_size' => 12,
                'responsibilities' => 'Lead marketing campaigns, manage brand strategy, oversee creative team',
                'notes' => 'Creative thinker with strong analytical skills',
            ],
            [
                'supervisor_id' => 'SUP-20250902-2003',
                'name' => 'David Thompson',
                'email' => 'david.thompson@example.com',
                'phone' => '+1-555-3001',
                'address' => '789 Leadership Dr, City, State 11111',
                'date_of_birth' => '1978-11-08',
                'gender' => 'male',
                'emergency_contact' => 'Sarah Thompson',
                'emergency_phone' => '+1-555-3002',
                'department' => 'Operations',
                'position' => 'Operations Manager',
                'employee_id' => 'EMP003',
                'bank_name' => 'Regional Bank',
                'bank_account' => '7777888899',
                'tax_id' => '777-88-9999',
                'base_salary' => 4800.00,
                'bonus_percentage' => 12.00,
                'status' => 'active',
                'join_date' => '2018-08-10',
                'promotion_date' => '2020-12-01',
                'team_size' => 15,
                'responsibilities' => 'Oversee daily operations, manage logistics, ensure quality control',
                'notes' => 'Detail-oriented with excellent problem-solving skills',
            ],
            [
                'supervisor_id' => 'SUP-20250902-2004',
                'name' => 'Lisa Chen',
                'email' => 'lisa.chen@example.com',
                'phone' => '+1-555-4001',
                'address' => '321 Innovation St, City, State 22222',
                'date_of_birth' => '1983-04-12',
                'gender' => 'female',
                'emergency_contact' => 'Michael Chen',
                'emergency_phone' => '+1-555-4002',
                'department' => 'IT',
                'position' => 'IT Team Lead',
                'employee_id' => 'EMP004',
                'bank_name' => 'Tech Bank',
                'bank_account' => '0000111122',
                'tax_id' => '000-11-2222',
                'base_salary' => 5500.00,
                'bonus_percentage' => 18.00,
                'status' => 'active',
                'join_date' => '2021-01-05',
                'promotion_date' => '2023-03-01',
                'team_size' => 6,
                'responsibilities' => 'Lead development team, manage projects, ensure system reliability',
                'notes' => 'Technical expert with strong leadership abilities',
            ],
            [
                'supervisor_id' => 'SUP-20250902-2005',
                'name' => 'Michael Rodriguez',
                'email' => 'michael.rodriguez@example.com',
                'phone' => '+1-555-5001',
                'address' => '654 Senior Way, City, State 33333',
                'date_of_birth' => '1975-12-03',
                'gender' => 'male',
                'emergency_contact' => 'Ana Rodriguez',
                'emergency_phone' => '+1-555-5002',
                'department' => 'Finance',
                'position' => 'Finance Manager',
                'employee_id' => 'EMP005',
                'bank_name' => 'Financial Bank',
                'bank_account' => '3333444455',
                'tax_id' => '333-44-5555',
                'base_salary' => 5800.00,
                'bonus_percentage' => 25.00,
                'status' => 'retired',
                'join_date' => '2015-06-15',
                'promotion_date' => '2018-01-01',
                'team_size' => 10,
                'responsibilities' => 'Manage financial planning, oversee budgets, ensure compliance',
                'notes' => 'Retired after 8 years of excellent service',
            ],
        ];

        foreach ($supervisors as $supervisorData) {
            Supervisor::firstOrCreate(
                ['email' => $supervisorData['email']],
                $supervisorData
            );
        }
    }
}
