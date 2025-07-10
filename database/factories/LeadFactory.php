<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'lead_number' => 'L-' . $this->faker->unique()->randomNumber(5),
            'client_first_name' => $this->faker->firstName(),
            'client_last_name' => $this->faker->lastName(),
            'client_email' => $this->faker->unique()->safeEmail(),
            'client_phone' => $this->faker->phoneNumber(),
            'client_address' => $this->faker->address(),
            'client_city' => $this->faker->city(),
            'client_country' => $this->faker->country(),
            'product_interest' => $this->faker->word(),
            'budget_range' => $this->faker->randomElement(['<10k', '10k-50k', '50k-100k', '>100k']),
            'timeline' => $this->faker->randomElement(['1-3 months', '3-6 months', '>6 months']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'source' => $this->faker->word(),
            'notes' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['new', 'assigned', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost', 'cancelled']),
            'substatus' => $this->faker->word(),
            'assigned_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'first_contact_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'last_activity_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'estimated_value' => $this->faker->randomFloat(2, 100, 100000),
            'actual_value' => $this->faker->randomFloat(2, 100, 100000),
            'commission_rate' => $this->faker->randomFloat(2, 5, 20),
            'commission_amount' => $this->faker->randomFloat(2, 10, 20000),
            // Foreign keys will be handled in seeders or when creating leads directly
        ];
    }
}
