<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Certificate $certificate)
    {
        return $user->id === $certificate->user_id || $user->isAdmin() || $user->isMaintainer();
    }
}
