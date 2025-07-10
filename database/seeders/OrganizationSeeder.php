<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organization;
use Illuminate\Support\Str;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::firstOrCreate(
            ['code' => 'PROTECTA_GROUP'],
            [
                'uuid' => Str::uuid(),
                'name' => 'Protecta Group',
                'type' => 'protecta_group',
                'address' => '123 Protecta St, City, Country',
                'phone' => '+1234567890',
                'email' => 'info@protectagroup.com',
                'logo' => null,
                'settings' => json_encode(['default_currency' => 'USD']),
                'status' => 'active',
            ]
        );
    }
}
