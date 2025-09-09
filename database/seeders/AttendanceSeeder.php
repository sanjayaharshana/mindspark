<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\EventJob;
use App\Models\PromoterEventJob;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all event jobs that have dates set
        $eventJobs = EventJob::whereNotNull('activation_start_date')
            ->whereNotNull('activation_end_date')
            ->get();

        foreach ($eventJobs as $eventJob) {
            // Get all promoters assigned to this event
            $assignedPromoters = PromoterEventJob::where('event_id', $eventJob->id)->get();

            if ($assignedPromoters->isEmpty()) {
                continue;
            }

            // Generate attendance for each day of the event
            $startDate = Carbon::parse($eventJob->activation_start_date);
            $endDate = Carbon::parse($eventJob->activation_end_date);

            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                foreach ($assignedPromoters as $assignment) {
                    // Randomly assign attendance status (80% present, 20% absent)
                    $status = rand(1, 100) <= 80 ? 'attend' : 'absent';
                    
                    // Create attendance record
                    Attendance::create([
                        'promoter_id' => $assignment->promoter_id,
                        'promoter_attend_date' => $currentDate->format('Y-m-d'),
                        'event_id' => $eventJob->id,
                        'status' => $status,
                    ]);
                }
                $currentDate->addDay();
            }
        }

        $this->command->info('Attendance data seeded successfully!');
    }
}
