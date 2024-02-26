<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class UserObserver
{
    public function created(User $user)
    {
        $user->slug = Str::slug($user->name . '-' .  Str::substr($user->id, 1, 9));
        $user->save();
    }

    public function updating(User $user)
    {
        if ($user->getOriginal('photo') && $user->getOriginal('photo') != $user->photo) Storage::disk('public')->delete($user->getOriginal('photo'));
    }

    public function deleted(User $user)
    {
        if ($user->getOriginal('photo')) Storage::disk('public')->delete($user->getOriginal('photo'));
    }
}
