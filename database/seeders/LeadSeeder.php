<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are users, organizations, and teams to link leads to
        $users = User::all();
        $organizations = Organization::all();
        $teams = Team::all();

        if ($users->isEmpty()) {
            // Create some users if none exist (e.g., from UserSeeder if implemented later)
            User::factory()->count(5)->create();
            $users = User::all();
        }

        if ($organizations->isEmpty()) {
            // Create default organization if none exists
            $this->call(OrganizationSeeder::class);
            $organizations = Organization::all();
        }

        if ($teams->isEmpty()) {
            // Create some dummy teams if none exist
            // For simplicity, link to the first organization and a random manager
            Team::factory()->count(3)->create(['organization_id' => $organizations->first()->id, 'manager_id' => $users->random()->id]);
            $teams = Team::all();
        }

        Lead::factory()->count(50)->create(function (array $attributes) use ($users, $organizations, $teams) {
            return [
                'referral_id' => $users->random()->id,
                'assigned_to' => $users->random()->id,
                'organization_id' => $organizations->random()->id,
                'team_id' => $teams->random()->id,
            ];
        });
    }
}
