<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'appointment_date' => $this->faker->date(),
            'appointment_time' => $this->faker->time('H:i:s'),
            'duration_minutes' => $this->faker->numberBetween(30, 120),
            'location' => $this->faker->address(),
            'meeting_type' => $this->faker->randomElement(['in_person', 'phone', 'video', 'online']),
            'status' => $this->faker->randomElement(['scheduled', 'confirmed', 'completed', 'cancelled', 'rescheduled']),
            'outcome' => $this->faker->randomElement(['successful', 'no_show', 'reschedule_requested', 'not_interested', 'follow_up_needed']),
            'outcome_notes' => $this->faker->paragraph(),
            'reminder_sent' => $this->faker->boolean(),
            'confirmed_by_client' => $this->faker->boolean(),
            // Foreign keys will be handled in seeders or when creating appointments directly
        ];
    }
}
