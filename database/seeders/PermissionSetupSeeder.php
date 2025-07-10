<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear everything first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Cleared all existing permissions and roles.');

        // Create permissions that EXACTLY match your policies
        $permissions = [
            // Organization permissions (from OrganizationPolicy)
            'view-any Organization',
            'view Organization',
            'create Organization',
            'update Organization',
            'delete Organization',
            'restore Organization',
            'force-delete Organization',

            // Team permissions (from TeamPolicy)
            'view teams',
            'create teams',
            'update teams',
            'delete teams',
            'manage teams',
            'restore teams',
            'force delete teams',

            // Lead permissions (from LeadPolicy)
            'view leads',
            'create leads',
            'update leads',
            'delete leads',
            'manage leads',
            'restore leads',
            'force delete leads',

            // Appointment permissions (from AppointmentPolicy)
            'view appointments',
            'create appointments',
            'update appointments',
            'delete appointments',
            'manage appointments',
            'restore appointments',
            'force delete appointments',

            // Lead Activity permissions (from LeadActivityPolicy)
            'view lead activities',
            'create lead activities',
            'update lead activities',
            'delete lead activities',
            'manage lead activities',
            'restore lead activities',
            'force delete lead activities',

            // Notification permissions (from NotificationPolicy)
            'view notifications',
            'create notifications',
            'update notifications',
            'delete notifications',
            'manage notifications',
            'restore notifications',
            'force delete notifications',

            // Revenue Tracking permissions (from RevenueTrackingPolicy)
            'view revenue tracking',
            'create revenue tracking',
            'update revenue tracking',
            'delete revenue tracking',
            'manage revenue tracking',
            'restore revenue tracking',
            'force delete revenue tracking',

            // System Setting permissions (from SystemSettingPolicy)
            'view system settings',
            'create system settings',
            'update system settings',
            'delete system settings',
            'manage system settings',
            'restore system settings',
            'force delete system settings',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $this->command->info('Created ' . count($permissions) . ' permissions.');

        // Create roles with correct slugs and descriptions
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'System administrator with full access'
            ],
            [
                'name' => 'Director',
                'slug' => 'director',
                'description' => 'Director with organization management access'
            ],
            [
                'name' => 'Sales Manager',
                'slug' => 'sales_manager',
                'description' => 'Sales team manager'
            ],
            [
                'name' => 'Sales Agent',
                'slug' => 'sales_agent',
                'description' => 'Sales representative'
            ],
            [
                'name' => 'Referral',
                'slug' => 'referral',
                'description' => 'Referral partner'
            ],
            ['name' => 'Client', 'slug' => 'client', 'description' => 'Client user'],
            ['name' => 'Partner Admin', 'slug' => 'partner_admin', 'description' => 'Partner administrator'],
        ];

        foreach ($roles as $roleData) {
            Role::create([
                'name' => $roleData['name'],
                'slug' => $roleData['slug'],
                'description' => $roleData['description'],
                'guard_name' => 'web',
            ]);
        }

        $this->command->info('Created ' . count($roles) . ' roles.');

        // Get all permissions and admin role
        $allPermissions = Permission::all();
        $adminRole = Role::where('slug', 'admin')->first();

        // Assign ALL permissions to Admin role
        $rolePermissions = [];
        foreach ($allPermissions as $permission) {
            $rolePermissions[] = [
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id,
            ];
        }

        DB::table('role_has_permissions')->insert($rolePermissions);
        $this->command->info("Assigned {$allPermissions->count()} permissions to Admin role.");

        // Assign specific permissions to other roles
        $this->assignPermissionsToRole('director', [
            'view-any Organization',
            'view Organization',
            'update Organization',
            'view teams',
            'create teams',
            'update teams',
            'manage teams',
            'view leads',
            'create leads',
            'update leads',
            'manage leads',
            'view appointments',
            'manage appointments',
            'view revenue tracking',
            'manage revenue tracking',
        ]);

        $this->assignPermissionsToRole('sales_manager', [
            'view teams',
            'view leads',
            'create leads',
            'update leads',
            'view appointments',
            'create appointments',
            'update appointments',
            'view lead activities',
            'create lead activities',
            'update lead activities',
            'view revenue tracking',
            'view notifications',
        ]);

        $this->assignPermissionsToRole('sales_agent', [
            'view leads',
            'update leads',
            'view appointments',
            'create appointments',
            'update appointments',
            'view lead activities',
            'create lead activities',
            'update lead activities',
            'view notifications',
        ]);

        $this->assignPermissionsToRole('referral', [
            'view leads',
            'create leads',
            'view appointments',
            'view revenue tracking',
            'view notifications',
        ]);

        // Assign Admin role to admin user
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            DB::table('model_has_roles')->insert([
                'role_id' => $adminRole->id,
                'model_type' => User::class,
                'model_id' => $adminUser->id,
            ]);

            $this->command->info("Admin role assigned to admin@example.com");
        } else {
            $this->command->warn("Admin user not found.");
        }

        // Clear cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Fixed permission setup completed successfully!');
    }

    /**
     * Assign permissions to role by slug
     */
    private function assignPermissionsToRole(string $roleSlug, array $permissionNames): void
    {
        $role = Role::where('slug', $roleSlug)->first();

        if (!$role) {
            $this->command->warn("Role '$roleSlug' not found.");
            return;
        }

        $permissions = Permission::whereIn('name', $permissionNames)->get();

        if ($permissions->isEmpty()) {
            $this->command->warn("No permissions found for role '$roleSlug'.");
            return;
        }

        $rolePermissions = [];
        foreach ($permissions as $permission) {
            $rolePermissions[] = [
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ];
        }

        DB::table('role_has_permissions')->insert($rolePermissions);
        $this->command->info("Assigned {$permissions->count()} permissions to role '$roleSlug'.");
    }
}
