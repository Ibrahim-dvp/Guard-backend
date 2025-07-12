<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Pest\Faker;

use PHPUnit\Framework\Attributes\Test;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Role $role;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and role for testing
        $this->role = Role::create(['name' => 'test-role', 'slug' => 'test-role', 'guard_name' => 'web']);
        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
    }

    #[Test]
    public function unauthenticated_user_cannot_access_organizations_index(): void
    {
        $response = $this->getJson('/api/organizations');

        $response->assertStatus(401);
    }

    #[Test]
    public function authenticated_user_without_permission_cannot_access_organizations_index(): void
    {
        // Create the permission so the authorize method can find it
        Permission::create(['name' => 'view-any Organization', 'guard_name' => 'web']);

        $response = $this->actingAs($this->user)->getJson('/api/organizations');

        $response->assertStatus(403);
    }

    #[Test]
    public function authenticated_user_with_permission_can_access_organizations_index(): void
    {
        // Create the permission and assign it to the role
        $permission = Permission::create(['name' => 'view-any Organization', 'guard_name' => 'web']);
        $this->role->givePermissionTo($permission);

        // Create some organizations to test with
        Organization::factory()->count(5)->create();

        $response = $this->actingAs($this->user)->getJson('/api/organizations');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data' => [
                    '*' => [
                        'id',
                        'uuid',
                        'name',
                        'type',
                        'code',
                        'address',
                        'phone',
                        'email',
                        'logo',
                        'settings',
                        'status',
                    ]
                ],
                'pagination' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'total',
                ]
            ]);
    }
}
