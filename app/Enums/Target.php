<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Target: int
{
    use ToArray;

    case Seekers = 1;
    case Facilitators = 2;


    public function name(): string
    {
        return match ($this) {
            self::Seekers => __('Seekers'),
            self::Facilitators => __('Facilitators'),
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::Seekers => asset('assets/images/icons-target/seekers.png'),
            self::Facilitators => asset('assets/images/icons-target/facilitators.png'),
        };
    }
}
