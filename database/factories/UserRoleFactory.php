<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRole>
 */
class UserRoleFactory extends Factory
{
  public function definition(): array
  {
    return [
      'user_id' => null, // Set in seeder
      'role_id' => null, // Set in seeder
      'organization_id' => null, // Set in seeder
      'team_id' => null, // Set in seeder
      'assigned_by' => null, // Set in seeder
    ];
  }
}
