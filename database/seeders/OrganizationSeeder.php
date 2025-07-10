<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        // Default Protecta Group
        Organization::factory()->create([
            'name' => 'Protecta Group',
            'type' => 'protecta_group',
            'code' => 'PROTECTA',
            'status' => 'active',
        ]);

        // Partner organizations
        Organization::factory()->count(5)->create([
            'type' => 'partner',
            'status' => 'active',
        ]);
    }
}
