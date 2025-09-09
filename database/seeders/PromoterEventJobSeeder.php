<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoterEventJob;
use App\Models\Promoter;
use App\Models\EventJob;
use App\Models\Coordinator;

class PromoterEventJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventJobs = EventJob::all();
        $coordinators = Coordinator::all();
        
        // Get all promoters
        $promoters = Promoter::all();
        
        $assignments = [];
        
        foreach ($eventJobs as $eventJob) {
            // Get coordinators for this event job
            $eventCoordinators = $coordinators->where('event_job_id', $eventJob->id);
            
            if ($eventCoordinators->isEmpty()) {
                continue;
            }
            
            // Get promoters for this event job
            $eventPromoters = $promoters->where('event_job_id', $eventJob->id);
            
            if ($eventPromoters->isEmpty()) {
                continue;
            }
            
            // Assign 3-5 promoters per event job
            $promotersToAssign = $eventPromoters->random(min(5, $eventPromoters->count()));
            
            foreach ($promotersToAssign as $index => $promoter) {
                // Assign coordinator (cycle through available coordinators)
                $coordinator = $eventCoordinators->values()[$index % $eventCoordinators->count()];
                
                $assignments[] = [
                    'promoter_id' => $promoter->id,
                    'event_id' => $eventJob->id,
                    'supervisor_id' => $coordinator->id,
                    'supervisor_commission' => rand(500, 1500), // Rs. 500-1500 per day
                    'promoter_salary_per_day' => rand(2000, 4000), // Rs. 2000-4000 per day
                ];
            }
        }
        
        // Create additional assignments for some promoters to multiple events
        $additionalAssignments = [
            [
                'promoter_id' => $promoters->where('promoter_id', 'PROM1001')->first()->id,
                'event_id' => $eventJobs->where('job_number', 'EJ1002')->first()->id,
                'supervisor_id' => $coordinators->where('coordinator_id', 'COORD1002')->first()->id,
                'supervisor_commission' => 800,
                'promoter_salary_per_day' => 2500,
            ],
            [
                'promoter_id' => $promoters->where('promoter_id', 'PROM1002')->first()->id,
                'event_id' => $eventJobs->where('job_number', 'EJ1003')->first()->id,
                'supervisor_id' => $coordinators->where('coordinator_id', 'COORD1003')->first()->id,
                'supervisor_commission' => 1200,
                'promoter_salary_per_day' => 3000,
            ],
            [
                'promoter_id' => $promoters->where('promoter_id', 'PROM1003')->first()->id,
                'event_id' => $eventJobs->where('job_number', 'EJ1004')->first()->id,
                'supervisor_id' => $coordinators->where('coordinator_id', 'COORD1004')->first()->id,
                'supervisor_commission' => 1000,
                'promoter_salary_per_day' => 2800,
            ],
            [
                'promoter_id' => $promoters->where('promoter_id', 'PROM1004')->first()->id,
                'event_id' => $eventJobs->where('job_number', 'EJ1005')->first()->id,
                'supervisor_id' => $coordinators->where('coordinator_id', 'COORD1005')->first()->id,
                'supervisor_commission' => 900,
                'promoter_salary_per_day' => 3200,
            ],
            [
                'promoter_id' => $promoters->where('promoter_id', 'PROM1005')->first()->id,
                'event_id' => $eventJobs->where('job_number', 'EJ1006')->first()->id,
                'supervisor_id' => $coordinators->where('coordinator_id', 'COORD1006')->first()->id,
                'supervisor_commission' => 1100,
                'promoter_salary_per_day' => 2600,
            ],
        ];
        
        // Merge all assignments
        $allAssignments = array_merge($assignments, $additionalAssignments);
        
        foreach ($allAssignments as $assignment) {
            // Check if assignment already exists to avoid duplicates
            $exists = PromoterEventJob::where('promoter_id', $assignment['promoter_id'])
                ->where('event_id', $assignment['event_id'])
                ->exists();
                
            if (!$exists) {
                PromoterEventJob::create($assignment);
            }
        }
    }
}
