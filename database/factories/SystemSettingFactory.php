<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SystemSetting>
 */
class SystemSettingFactory extends Factory
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
            'key' => $this->faker->unique()->word(),
            'value' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['string', 'integer', 'boolean', 'json']),
            'description' => $this->faker->sentence(),
            'is_public' => $this->faker->boolean(),
        ];
    }
}
