<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeadActivity;
use App\Models\Lead;
use App\Models\User;

class LeadActivitySeeder extends Seeder
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

        LeadActivity::factory()->count(50)->create(function (array $attributes) use ($leads, $users) {
            return [
                'lead_id' => $leads->random()->id,
                'user_id' => $users->random()->id,
            ];
        });
    }
}
