<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coordinator;
use App\Models\EventJob;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventJobs = EventJob::all();
        
        $coordinators = [
            [
                'coordinator_id' => 'COORD1001',
                'coordinator_name' => 'Samantha Perera',
                'nic_no' => '901234567V',
                'phone_no' => '077-1234567',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Colombo Fort Branch',
                'account_number' => '1234567890',
            ],
            [
                'coordinator_id' => 'COORD1002',
                'coordinator_name' => 'Dinesh Fernando',
                'nic_no' => '902345678V',
                'phone_no' => '071-2345678',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Kandy Branch',
                'account_number' => '2345678901',
            ],
            [
                'coordinator_id' => 'COORD1003',
                'coordinator_name' => 'Nimali Jayawardena',
                'nic_no' => '903456789V',
                'phone_no' => '076-3456789',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Galle Branch',
                'account_number' => '3456789012',
            ],
            [
                'coordinator_id' => 'COORD1004',
                'coordinator_name' => 'Rukshan Mendis',
                'nic_no' => '904567890V',
                'phone_no' => '075-4567890',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Negombo Branch',
                'account_number' => '4567890123',
            ],
            [
                'coordinator_id' => 'COORD1005',
                'coordinator_name' => 'Priyanka Wickramasinghe',
                'nic_no' => '905678901V',
                'phone_no' => '077-5678901',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Kurunegala Branch',
                'account_number' => '5678901234',
            ],
            [
                'coordinator_id' => 'COORD1006',
                'coordinator_name' => 'Chaminda Bandara',
                'nic_no' => '906789012V',
                'phone_no' => '071-6789012',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Anuradhapura Branch',
                'account_number' => '6789012345',
            ],
            [
                'coordinator_id' => 'COORD1007',
                'coordinator_name' => 'Sanduni Gunasekara',
                'nic_no' => '907890123V',
                'phone_no' => '076-7890123',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Jaffna Branch',
                'account_number' => '7890123456',
            ],
            [
                'coordinator_id' => 'COORD1008',
                'coordinator_name' => 'Tharindu Rajapaksa',
                'nic_no' => '908901234V',
                'phone_no' => '075-8901234',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Trincomalee Branch',
                'account_number' => '8901234567',
            ],
            [
                'coordinator_id' => 'COORD1009',
                'coordinator_name' => 'Anushka Silva',
                'nic_no' => '909012345V',
                'phone_no' => '077-9012345',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Batticaloa Branch',
                'account_number' => '9012345678',
            ],
            [
                'coordinator_id' => 'COORD1010',
                'coordinator_name' => 'Dilani Karunaratne',
                'nic_no' => '910123456V',
                'phone_no' => '071-0123456',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Ratnapura Branch',
                'account_number' => '0123456789',
            ],
            [
                'coordinator_id' => 'COORD1011',
                'coordinator_name' => 'Kavinda Perera',
                'nic_no' => '911234567V',
                'phone_no' => '076-1234567',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Matara Branch',
                'account_number' => '1234567890',
            ],
            [
                'coordinator_id' => 'COORD1012',
                'coordinator_name' => 'Nishadi Fernando',
                'nic_no' => '912345678V',
                'phone_no' => '075-2345678',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Chilaw Branch',
                'account_number' => '2345678901',
            ],
        ];

        foreach ($coordinators as $index => $coordinator) {
            // Assign coordinators to event jobs
            $eventJob = $eventJobs[$index % $eventJobs->count()];
            $coordinator['event_job_id'] = $eventJob->id;
            
            Coordinator::create($coordinator);
        }
    }
}
