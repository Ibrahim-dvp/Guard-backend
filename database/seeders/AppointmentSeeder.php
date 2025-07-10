<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Lead;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = Lead::all();
        $users = User::all();

        if ($leads->isEmpty()) {
            // If no leads exist, run the LeadSeeder
            $this->call(LeadSeeder::class);
            $leads = Lead::all();
        }

        if ($users->isEmpty()) {
            // Create some users if none exist
            User::factory()->count(5)->create();
            $users = User::all();
        }

        Appointment::factory()->count(20)->create(function (array $attributes) use ($leads, $users) {
            return [
                'lead_id' => $leads->random()->id,
                'sales_agent_id' => $users->random()->id,
            ];
        });
    }
}
