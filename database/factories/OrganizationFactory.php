<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
  public function definition(): array
  {
    return [
      'uuid' => $this->faker->uuid(),
      'name' => $this->faker->company(),
      'type' => $this->faker->randomElement(['protecta_group', 'partner']),
      'code' => strtoupper($this->faker->unique()->bothify('ORG###')),
      'address' => $this->faker->address(),
      'phone' => $this->faker->phoneNumber(),
      'email' => $this->faker->companyEmail(),
      'logo' => $this->faker->imageUrl(),
      'settings' => json_encode(['currency' => $this->faker->currencyCode()]),
      'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
    ];
  }
}
