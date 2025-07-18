<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any Appointment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->hasPermissionTo('view Appointment')
            || $user->id === $appointment->user_id // The user who created the appointment
            || $user->id === $appointment->lead->assigned_to; // The sales agent assigned to the lead associated with the appointment
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create Appointment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointment $appointment): bool
    {
        return $user->hasPermissionTo('update Appointment')
            || $user->id === $appointment->user_id
            || $user->id === $appointment->lead->assigned_to;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->hasPermissionTo('delete Appointment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointment $appointment): bool
    {
        return $user->hasPermissionTo('restore Appointment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $appointment): bool
    {
        return $user->hasPermissionTo('force-delete Appointment');
    }
}
