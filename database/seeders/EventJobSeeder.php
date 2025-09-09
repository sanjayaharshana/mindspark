<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventJob;
use Carbon\Carbon;

class EventJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventJobs = [
            [
                'job_number' => 'EJ1001',
                'job_name' => 'Ceylon Tea Festival 2024',
                'client_name' => 'Ceylon Tea Company',
                'activation_start_date' => Carbon::now()->addDays(30),
                'activation_end_date' => Carbon::now()->addDays(35),
                'officer_name' => 'Kumara Bandara',
                'reporter_officer_name' => 'Priyanka Wickramasinghe',
            ],
            [
                'job_number' => 'EJ1002',
                'job_name' => 'Health Awareness Campaign',
                'client_name' => 'Lanka Hospitals',
                'activation_start_date' => Carbon::now()->addDays(15),
                'activation_end_date' => Carbon::now()->addDays(22),
                'officer_name' => 'Dr. Nimal Perera',
                'reporter_officer_name' => 'Sanduni Fernando',
            ],
            [
                'job_number' => 'EJ1003',
                'job_name' => 'Dialog 5G Launch Event',
                'client_name' => 'Dialog Axiata',
                'activation_start_date' => Carbon::now()->addDays(45),
                'activation_end_date' => Carbon::now()->addDays(50),
                'officer_name' => 'Kavinda Silva',
                'reporter_officer_name' => 'Rukshan Mendis',
            ],
            [
                'job_number' => 'EJ1004',
                'job_name' => 'John Keells Corporate Event',
                'client_name' => 'John Keells Holdings',
                'activation_start_date' => Carbon::now()->addDays(20),
                'activation_end_date' => Carbon::now()->addDays(25),
                'officer_name' => 'Sanduni Fernando',
                'reporter_officer_name' => 'Tharindu Rajapaksa',
            ],
            [
                'job_number' => 'EJ1005',
                'job_name' => 'Sri Lanka Tourism Expo',
                'client_name' => 'Sri Lanka Tourism Promotion Bureau',
                'activation_start_date' => Carbon::now()->addDays(60),
                'activation_end_date' => Carbon::now()->addDays(65),
                'officer_name' => 'Rukshan Mendis',
                'reporter_officer_name' => 'Anushka Jayawardena',
            ],
            [
                'job_number' => 'EJ1006',
                'job_name' => 'MAS Fashion Week',
                'client_name' => 'MAS Holdings',
                'activation_start_date' => Carbon::now()->addDays(40),
                'activation_end_date' => Carbon::now()->addDays(45),
                'officer_name' => 'Tharindu Rajapaksa',
                'reporter_officer_name' => 'Dilani Gunasekara',
            ],
            [
                'job_number' => 'EJ1007',
                'job_name' => 'World Vision Charity Drive',
                'client_name' => 'World Vision Sri Lanka',
                'activation_start_date' => Carbon::now()->addDays(10),
                'activation_end_date' => Carbon::now()->addDays(17),
                'officer_name' => 'Anushka Jayawardena',
                'reporter_officer_name' => 'Chaminda Bandara',
            ],
            [
                'job_number' => 'EJ1008',
                'job_name' => 'Cargills Food Festival',
                'client_name' => 'Cargills Ceylon',
                'activation_start_date' => Carbon::now()->addDays(25),
                'activation_end_date' => Carbon::now()->addDays(30),
                'officer_name' => 'Dilani Gunasekara',
                'reporter_officer_name' => 'Nishadi Karunaratne',
            ],
            [
                'job_number' => 'EJ1009',
                'job_name' => 'HNB Banking Seminar',
                'client_name' => 'Hatton National Bank',
                'activation_start_date' => Carbon::now()->addDays(35),
                'activation_end_date' => Carbon::now()->addDays(37),
                'officer_name' => 'Chaminda Bandara',
                'reporter_officer_name' => 'Kumara Bandara',
            ],
            [
                'job_number' => 'EJ1010',
                'job_name' => 'Sri Lankan Airlines Promotion',
                'client_name' => 'Sri Lankan Airlines',
                'activation_start_date' => Carbon::now()->addDays(50),
                'activation_end_date' => Carbon::now()->addDays(55),
                'officer_name' => 'Nishadi Karunaratne',
                'reporter_officer_name' => 'Dr. Nimal Perera',
            ],
            [
                'job_number' => 'EJ1011',
                'job_name' => 'Colombo Shopping Mall Launch',
                'client_name' => 'John Keells Holdings',
                'activation_start_date' => Carbon::now()->addDays(70),
                'activation_end_date' => Carbon::now()->addDays(75),
                'officer_name' => 'Sanduni Fernando',
                'reporter_officer_name' => 'Kavinda Silva',
            ],
            [
                'job_number' => 'EJ1012',
                'job_name' => 'Dialog Digital Innovation Summit',
                'client_name' => 'Dialog Axiata',
                'activation_start_date' => Carbon::now()->addDays(80),
                'activation_end_date' => Carbon::now()->addDays(82),
                'officer_name' => 'Kavinda Silva',
                'reporter_officer_name' => 'Rukshan Mendis',
            ],
        ];

        foreach ($eventJobs as $eventJob) {
            EventJob::create($eventJob);
        }
    }
}
