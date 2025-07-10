<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'slug' => 'admin', 'description' => 'System administrator', 'is_system' => true],
            ['name' => 'director', 'slug' => 'director', 'description' => 'Protecta Group director', 'is_system' => true],
            ['name' => 'coordinator', 'slug' => 'coordinator', 'description' => 'Lead coordinator', 'is_system' => true],
            ['name' => 'sales_manager', 'slug' => 'sales_manager', 'description' => 'Sales team manager', 'is_system' => true],
            ['name' => 'sales_agent', 'slug' => 'sales_agent', 'description' => 'Sales agent', 'is_system' => true],
            ['name' => 'referral', 'slug' => 'referral', 'description' => 'Referral dealer', 'is_system' => true],
            ['name' => 'client', 'slug' => 'client', 'description' => 'Client user', 'is_system' => true],
            ['name' => 'partner_admin', 'slug' => 'partner_admin', 'description' => 'Partner administrator', 'is_system' => true],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
