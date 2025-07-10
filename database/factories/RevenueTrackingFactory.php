<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RevenueTracking>
 */
class RevenueTrackingFactory extends Factory
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
            'deal_value' => $this->faker->randomFloat(2, 500, 500000),
            'commission_rate' => $this->faker->randomFloat(2, 5, 20),
            'commission_amount' => $this->faker->randomFloat(2, 50, 100000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'paid', 'disputed']),
            'payment_date' => $this->faker->optional()->date(),
            // Foreign keys will be handled in seeders or when creating revenue tracking directly
        ];
    }
}
