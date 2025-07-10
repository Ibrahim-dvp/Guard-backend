<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
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
            'type' => $this->faker->randomElement(['lead_assigned', 'appointment_reminder', 'system_alert', 'new_message']),
            'title' => $this->faker->sentence(5),
            'message' => $this->faker->paragraph(),
            'data' => json_encode(['key' => $this->faker->word(), 'value' => $this->faker->sentence()]),
            'channels' => json_encode([$this->faker->randomElement(['email', 'sms', 'in-app'])]), // Use JSON for channels
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => $this->faker->randomElement(['pending', 'sent', 'delivered', 'failed', 'read']),
            'sent_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'read_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            // Foreign keys will be handled in seeders or when creating notifications directly
        ];
    }
}
