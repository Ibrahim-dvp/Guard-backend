<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RevenueTracking;
use App\Models\Lead;
use App\Models\User;

class RevenueTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = Lead::all();
        $users = User::all();

        if ($leads->isEmpty()) {
            $this->call(LeadSeeder::class);
            $leads = Lead::all();
        }

        if ($users->isEmpty()) {
            User::factory()->count(5)->create();
            $users = User::all();
        }

        RevenueTracking::factory()->count(20)->create(function (array $attributes) use ($leads, $users) {
            return [
                'lead_id' => $leads->random()->id,
                'referral_id' => $users->random()->id,
                'sales_agent_id' => $users->random()->id,
            ];
        });
    }
}
