<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Director', 'slug' => 'director'],
            ['name' => 'Coordinator', 'slug' => 'coordinator'],
            ['name' => 'Sales Manager', 'slug' => 'sales_manager'],
            ['name' => 'Sales Agent', 'slug' => 'sales_agent'],
            ['name' => 'Referral', 'slug' => 'referral'],
            ['name' => 'Client', 'slug' => 'client'],
            ['name' => 'Partner Admin', 'slug' => 'partner_admin'],
        ];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'slug' => $role['slug'],
                'guard_name' => 'web',
            ]);
        }
    }
}
