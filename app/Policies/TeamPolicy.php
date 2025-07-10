<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view teams')
            || $user->hasPermissionTo('manage teams');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('view teams')
            || $user->hasPermissionTo('manage teams')
            || $user->id === $team->manager_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create teams')
            || $user->hasPermissionTo('manage teams');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('update teams')
            || $user->hasPermissionTo('manage teams');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('delete teams')
            || $user->hasPermissionTo('manage teams');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('restore teams')
            || $user->hasPermissionTo('manage teams');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $user->hasPermissionTo('force delete teams')
            || $user->hasPermissionTo('manage teams');
    }
}
