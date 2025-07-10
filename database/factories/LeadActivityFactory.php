<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadActivity>
 */
class LeadActivityFactory extends Factory
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
            'activity_type' => $this->faker->randomElement(['call', 'email', 'meeting', 'note']),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'outcome' => $this->faker->word(),
            'activity_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'duration_minutes' => $this->faker->optional()->numberBetween(10, 60),
            'metadata' => json_encode(['channel' => $this->faker->word()]),
            // Foreign keys will be handled in seeders or when creating activities directly
        ];
    }
}
