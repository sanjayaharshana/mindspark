<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_code' => 'CLI' . $this->faker->unique()->numberBetween(1000, 9999),
            'company_name' => $this->faker->company(),
            'contact_person_name' => $this->faker->name(),
            'contact_person_designation' => $this->faker->randomElement(['Manager', 'Director', 'CEO', 'Marketing Manager', 'HR Manager']),
            'email' => $this->faker->optional(0.9)->companyEmail(),
            'phone_number' => $this->faker->optional(0.7)->phoneNumber(),
            'mobile_number' => $this->faker->optional(0.8)->phoneNumber(),
            'address' => $this->faker->optional(0.8)->address(),
            'city' => $this->faker->optional(0.8)->city(),
            'state' => $this->faker->optional(0.7)->state(),
            'postal_code' => $this->faker->optional(0.6)->postcode(),
            'country' => $this->faker->optional(0.6)->country(),
            'website' => $this->faker->optional(0.5)->url(),
            'industry' => $this->faker->optional(0.7)->randomElement(['Technology', 'Healthcare', 'Finance', 'Retail', 'Manufacturing', 'Education', 'Real Estate']),
            'client_type' => $this->faker->randomElement(['individual', 'company', 'ngo', 'government']),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'notes' => $this->faker->optional(0.3)->paragraph(),
        ];
    }
}
