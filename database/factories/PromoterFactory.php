<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promoter>
 */
class PromoterFactory extends Factory
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
            'promoter_id' => 'PROM' . $this->faker->unique()->numberBetween(1000, 9999),
            'promoter_name' => $this->faker->name(),
            'id_no' => $this->faker->numerify('##########'),
            'phone_no' => $this->faker->optional(0.9)->phoneNumber(),
            'bank_name' => $this->faker->optional(0.8)->randomElement(['Commercial Bank', 'People\'s Bank', 'Sampath Bank', 'Hatton National Bank']),
            'bank_branch_name' => $this->faker->optional(0.8)->city() . ' Branch',
            'account_number' => $this->faker->optional(0.8)->numerify('##########'),
        ];
    }
}
