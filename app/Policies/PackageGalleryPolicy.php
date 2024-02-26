<?php

namespace App\Policies;

use App\Models\PackageGallery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackageGalleryPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, PackageGallery $gallery)
    {
        return $user->id === $gallery->package->service->user_id || $user->isAdmin() || $user->isMaintainer();
    }
}