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
            RoleSeeder::class,
            OrganizationSeeder::class,
            SystemSettingSeeder::class,
            // Note: LeadSeeder will create Users, Organizations, and Teams if they don't exist.
            // It also creates data for other related tables (Appointments, LeadActivities, RevenueTracking) implicitly.
            LeadSeeder::class,
            // Individual seeders for other tables can be called explicitly if more specific data is needed,
            // otherwise, LeadSeeder's factory callbacks will handle their creation with relationships.
            // AppointmentSeeder::class,
            // NotificationSeeder::class,
            // LeadActivitySeeder::class,
            // RevenueTrackingSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);
    }
}
