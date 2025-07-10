<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view leads')
            || $user->hasPermissionTo('manage leads');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lead $lead): bool
    {
        return $user->hasPermissionTo('view leads')
            || $user->hasPermissionTo('manage leads')
            || $user->id === $lead->user_id // Owner of the lead
            || $user->id === $lead->assigned_to; // Assigned sales agent
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create leads')
            || $user->hasPermissionTo('manage leads');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lead $lead): bool
    {
        return $user->hasPermissionTo('update leads')
            || $user->hasPermissionTo('manage leads')
            || $user->id === $lead->assigned_to; // Assigned sales agent can update status
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lead $lead): bool
    {
        return $user->hasPermissionTo('delete leads')
            || $user->hasPermissionTo('manage leads');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lead $lead): bool
    {
        return $user->hasPermissionTo('restore leads')
            || $user->hasPermissionTo('manage leads');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lead $lead): bool
    {
        return $user->hasPermissionTo('force delete leads')
            || $user->hasPermissionTo('manage leads');
    }
}
