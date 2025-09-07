<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventJob>
 */
class EventJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_number' => 'EJ' . $this->faker->unique()->numberBetween(1000, 9999),
            'job_name' => $this->faker->words(3, true) . ' Event',
            'client_name' => $this->faker->company(),
            'activation_start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'activation_end_date' => $this->faker->optional(0.8)->dateTimeBetween('+1 month', '+3 months'),
            'officer_name' => $this->faker->name(),
            'reporter_officer_name' => $this->faker->name(),
        ];
    }
}
