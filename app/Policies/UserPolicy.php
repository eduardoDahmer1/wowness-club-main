<?php

namespace App\Policies;

use App\Enums\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isMaintainer();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user->isAdmin() || $user->isMaintainer() || $user->id === $model->id;
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->isAdmin();
    }

    public function seekerViewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function practitionerViewAny(User $user)
    {
        return $user->isAdmin() || $user->isServiceProvider();
    }

    public function standardViewAny(User $user)
    {
        return $user->isPlanStandard() || $user->isPlanFoundingMember() || $user->isAdmin() || $user->isPlanProfessional();
    }

    public function freeViewAny(User $user)
    {
        return $user->isPlanFree() || !$user->subscription;
    }

    public function foundingMemberViewAny(User $user)
    {
        return $user->isPlanFoundingMember() || $user->isAdmin();
    }
}
