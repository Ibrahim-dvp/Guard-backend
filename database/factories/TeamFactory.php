<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
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
            'name' => $this->faker->company() . ' Team',
            'description' => $this->faker->sentence(),
            'area' => $this->faker->city(),
            'settings' => json_encode(['default_setting' => $this->faker->word()]),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            // organization_id and manager_id will be handled in the seeder
        ];
    }
}
