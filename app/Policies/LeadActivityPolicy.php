<?php

namespace App\Policies;

use App\Models\LeadActivity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadActivityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any LeadActivity');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeadActivity $leadActivity): bool
    {
        return $user->hasPermissionTo('view LeadActivity')
            || $user->id === $leadActivity->user_id // The user who created the activity
            || $user->id === $leadActivity->lead->assigned_to; // The sales agent assigned to the lead associated with the activity
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create LeadActivity');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LeadActivity $leadActivity): bool
    {
        return $user->hasPermissionTo('update LeadActivity')
            || $user->id === $leadActivity->user_id
            || $user->id === $leadActivity->lead->assigned_to;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeadActivity $leadActivity): bool
    {
        return $user->hasPermissionTo('delete LeadActivity');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeadActivity $leadActivity): bool
    {
        return $user->hasPermissionTo('restore LeadActivity');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeadActivity $leadActivity): bool
    {
        return $user->hasPermissionTo('force-delete LeadActivity');
    }
}
