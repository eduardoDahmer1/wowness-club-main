<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Gallery $gallery)
    {
        return $user->id === $gallery->service->user_id || $user->isAdmin() || $user->isMaintainer();
    }
}