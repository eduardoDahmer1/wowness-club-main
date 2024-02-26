<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Role: int
{
    use ToArray;

    case Admin = 1;
    case Maintainer = 2;
    case ServiceProvider = 3;
    case CommonUser = 4;

    public function name(): string
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::Maintainer => __('Maintainer'),
            self::ServiceProvider => __('Practitioner'),
            self::CommonUser => __('Seeker'),
        };
    }
}
