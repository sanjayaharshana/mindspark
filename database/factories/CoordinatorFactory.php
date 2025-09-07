<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coordinator>
 */
class CoordinatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_job_id' => \App\Models\EventJob::factory(),
            'coordinator_id' => 'COORD' . $this->faker->unique()->numberBetween(1000, 9999),
            'coordinator_name' => $this->faker->name(),
            'nic_no' => $this->faker->numerify('##########V'),
            'phone_no' => $this->faker->optional(0.9)->phoneNumber(),
            'bank_name' => $this->faker->optional(0.8)->randomElement(['Commercial Bank', 'People\'s Bank', 'Sampath Bank', 'Hatton National Bank']),
            'bank_branch_name' => $this->faker->optional(0.8)->city() . ' Branch',
            'account_number' => $this->faker->optional(0.8)->numerify('##########'),
        ];
    }
}
