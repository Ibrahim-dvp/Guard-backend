<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
  public function definition(): array
  {
    return [
      'name' => ucfirst($this->faker->unique()->word()),
      'slug' => $this->faker->unique()->slug(),
      'description' => $this->faker->sentence(),
      'permissions' => json_encode([]),
      'is_system' => $this->faker->boolean(),
      'guard_name' => 'web',
    ];
  }
}
