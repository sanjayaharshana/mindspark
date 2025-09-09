<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promoter;
use App\Models\EventJob;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventJobs = EventJob::all();
        
        $promoters = [
            [
                'promoter_id' => 'PROM1001',
                'promoter_name' => 'Kamal Perera',
                'id_no' => '901234567V',
                'phone_no' => '077-1234567',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Colombo Fort Branch',
                'account_number' => '1234567890',
            ],
            [
                'promoter_id' => 'PROM1002',
                'promoter_name' => 'Nimali Fernando',
                'id_no' => '902345678V',
                'phone_no' => '071-2345678',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Kandy Branch',
                'account_number' => '2345678901',
            ],
            [
                'promoter_id' => 'PROM1003',
                'promoter_name' => 'Rukshan Jayawardena',
                'id_no' => '903456789V',
                'phone_no' => '076-3456789',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Galle Branch',
                'account_number' => '3456789012',
            ],
            [
                'promoter_id' => 'PROM1004',
                'promoter_name' => 'Priyanka Mendis',
                'id_no' => '904567890V',
                'phone_no' => '075-4567890',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Negombo Branch',
                'account_number' => '4567890123',
            ],
            [
                'promoter_id' => 'PROM1005',
                'promoter_name' => 'Chaminda Wickramasinghe',
                'id_no' => '905678901V',
                'phone_no' => '077-5678901',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Kurunegala Branch',
                'account_number' => '5678901234',
            ],
            [
                'promoter_id' => 'PROM1006',
                'promoter_name' => 'Sanduni Bandara',
                'id_no' => '906789012V',
                'phone_no' => '071-6789012',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Anuradhapura Branch',
                'account_number' => '6789012345',
            ],
            [
                'promoter_id' => 'PROM1007',
                'promoter_name' => 'Tharindu Gunasekara',
                'id_no' => '907890123V',
                'phone_no' => '076-7890123',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Jaffna Branch',
                'account_number' => '7890123456',
            ],
            [
                'promoter_id' => 'PROM1008',
                'promoter_name' => 'Anushka Rajapaksa',
                'id_no' => '908901234V',
                'phone_no' => '075-8901234',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Trincomalee Branch',
                'account_number' => '8901234567',
            ],
            [
                'promoter_id' => 'PROM1009',
                'promoter_name' => 'Dilani Silva',
                'id_no' => '909012345V',
                'phone_no' => '077-9012345',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Batticaloa Branch',
                'account_number' => '9012345678',
            ],
            [
                'promoter_id' => 'PROM1010',
                'promoter_name' => 'Kavinda Karunaratne',
                'id_no' => '910123456V',
                'phone_no' => '071-0123456',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Ratnapura Branch',
                'account_number' => '0123456789',
            ],
            [
                'promoter_id' => 'PROM1011',
                'promoter_name' => 'Nishadi Perera',
                'id_no' => '911234567V',
                'phone_no' => '076-1234567',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Matara Branch',
                'account_number' => '1234567890',
            ],
            [
                'promoter_id' => 'PROM1012',
                'promoter_name' => 'Samantha Fernando',
                'id_no' => '912345678V',
                'phone_no' => '075-2345678',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Chilaw Branch',
                'account_number' => '2345678901',
            ],
            [
                'promoter_id' => 'PROM1013',
                'promoter_name' => 'Dinesh Jayawardena',
                'id_no' => '913456789V',
                'phone_no' => '077-3456789',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Kegalle Branch',
                'account_number' => '3456789012',
            ],
            [
                'promoter_id' => 'PROM1014',
                'promoter_name' => 'Nimali Mendis',
                'id_no' => '914567890V',
                'phone_no' => '071-4567890',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Polonnaruwa Branch',
                'account_number' => '4567890123',
            ],
            [
                'promoter_id' => 'PROM1015',
                'promoter_name' => 'Rukshan Wickramasinghe',
                'id_no' => '915678901V',
                'phone_no' => '076-5678901',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Badulla Branch',
                'account_number' => '5678901234',
            ],
            [
                'promoter_id' => 'PROM1016',
                'promoter_name' => 'Priyanka Bandara',
                'id_no' => '916789012V',
                'phone_no' => '075-6789012',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Monaragala Branch',
                'account_number' => '6789012345',
            ],
            [
                'promoter_id' => 'PROM1017',
                'promoter_name' => 'Chaminda Gunasekara',
                'id_no' => '917890123V',
                'phone_no' => '077-7890123',
                'bank_name' => 'Commercial Bank',
                'bank_branch_name' => 'Hambantota Branch',
                'account_number' => '7890123456',
            ],
            [
                'promoter_id' => 'PROM1018',
                'promoter_name' => 'Sanduni Rajapaksa',
                'id_no' => '918901234V',
                'phone_no' => '071-8901234',
                'bank_name' => 'People\'s Bank',
                'bank_branch_name' => 'Ampara Branch',
                'account_number' => '8901234567',
            ],
            [
                'promoter_id' => 'PROM1019',
                'promoter_name' => 'Tharindu Silva',
                'id_no' => '919012345V',
                'phone_no' => '076-9012345',
                'bank_name' => 'Sampath Bank',
                'bank_branch_name' => 'Vavuniya Branch',
                'account_number' => '9012345678',
            ],
            [
                'promoter_id' => 'PROM1020',
                'promoter_name' => 'Anushka Karunaratne',
                'id_no' => '920123456V',
                'phone_no' => '075-0123456',
                'bank_name' => 'Hatton National Bank',
                'bank_branch_name' => 'Mannar Branch',
                'account_number' => '0123456789',
            ],
        ];

        foreach ($promoters as $index => $promoter) {
            // Assign promoters to event jobs
            $eventJob = $eventJobs[$index % $eventJobs->count()];
            $promoter['event_job_id'] = $eventJob->id;
            
            Promoter::create($promoter);
        }
    }
}
