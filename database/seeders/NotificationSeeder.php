<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            // Create some users if none exist
            User::factory()->count(5)->create();
            $users = User::all();
        }

        Notification::factory()->count(30)->create(function (array $attributes) use ($users) {
            return [
                'recipient_id' => $users->random()->id,
                'sender_id' => $users->random()->id,
            ];
        });
    }
}
