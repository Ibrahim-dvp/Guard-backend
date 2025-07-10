<?php

namespace App\Policies;

use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SystemSettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SystemSetting $systemSetting): bool
    {
        return $user->hasPermissionTo('view system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SystemSetting $systemSetting): bool
    {
        return $user->hasPermissionTo('update system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SystemSetting $systemSetting): bool
    {
        return $user->hasPermissionTo('delete system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SystemSetting $systemSetting): bool
    {
        return $user->hasPermissionTo('restore system settings')
            || $user->hasPermissionTo('manage system settings');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SystemSetting $systemSetting): bool
    {
        return $user->hasPermissionTo('force delete system settings')
            || $user->hasPermissionTo('manage system settings');
    }
}
