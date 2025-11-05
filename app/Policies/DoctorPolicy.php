<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_doctors::doctor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Doctor $doctor): bool
    {
        return $user->can('view_doctors::doctor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_doctors::doctor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Doctor $doctor): bool
    {
        return $user->can('update_doctors::doctor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return $user->can('delete_doctors::doctor');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_doctors::doctor');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Doctor $doctor): bool
    {
        return $user->can('force_delete_doctors::doctor');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_doctors::doctor');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Doctor $doctor): bool
    {
        return $user->can('restore_doctors::doctor');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_doctors::doctor');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Doctor $doctor): bool
    {
        return $user->can('replicate_doctors::doctor');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_doctors::doctor');
    }
}
