<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Recurring: int
{
    use ToArray;

    case Notrepeat = 1;
    case Everyday = 2;
    case Everyweek = 3;
    // case Everymonth = 4;
    // case Everyyear = 5;
    case Custom = 6;

    public function name(): string
    {
        return match ($this) {
            self::Notrepeat => __('Does not repeat'),
            self::Everyday => __('Every day'),
            self::Everyweek => __('Every week'),
            // self::Everymonth => __('Every month'),
            // self::Everyyear => __('Every year'),
            self::Custom => __('+ Custom'),
        };
    }
}
