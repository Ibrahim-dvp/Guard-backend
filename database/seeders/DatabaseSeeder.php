<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Create organizations first (required by other entities)
            OrganizationSeeder::class,

            // 2. Create admin user (required for role assignment)
            AdminUserSeeder::class,

            // 3. Setup all permissions and roles (this replaces PermissionSeeder, RoleSeeder, and RolePermissionSeeder)
            PermissionSetupSeeder::class,

            // 4. Create system settings
            SystemSettingSeeder::class,

            // 5. Create sample data (these will create more users, leads, etc.)
            LeadSeeder::class,
            AppointmentSeeder::class,
            LeadActivitySeeder::class,
            NotificationSeeder::class,
            RevenueTrackingSeeder::class,
        ]);

        // Create additional test user
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);

        $this->command->info('Database seeding completed successfully!');
        $this->command->info('Admin user: admin@example.com / password');
        $this->command->info('Test user: test@example.com / password');
    }
}
