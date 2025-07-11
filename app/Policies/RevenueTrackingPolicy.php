<?php

namespace App\Policies;

use App\Models\RevenueTracking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RevenueTrackingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any RevenueTracking');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RevenueTracking $revenueTracking): bool
    {
        return $user->hasPermissionTo('view RevenueTracking')
            || $user->id === $revenueTracking->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create RevenueTracking');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RevenueTracking $revenueTracking): bool
    {
        return $user->hasPermissionTo('update RevenueTracking');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RevenueTracking $revenueTracking): bool
    {
        return $user->hasPermissionTo('delete RevenueTracking');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RevenueTracking $revenueTracking): bool
    {
        return $user->hasPermissionTo('restore RevenueTracking');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RevenueTracking $revenueTracking): bool
    {
        return $user->hasPermissionTo('force-delete RevenueTracking');
    }
}
