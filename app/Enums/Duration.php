<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Duration: int
{
    use ToArray;

    case Day = 1;
    case Hour = 2;
    case Minute = 3;

    public function name(): string
    {
        return match ($this) {
            self::Day => __('Day'),
            self::Hour => __('Hour'),
            self::Minute => __('Minute'),
        };
    }
}