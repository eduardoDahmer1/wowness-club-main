<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Aimed: int
{
    use ToArray;

    case MenOnly = 1;
    case  GayWoman = 2;
    case  GayMen = 3;
    case  Couple = 4;
    case  WomenOnly = 5;
    case  Single = 6;
    case Anyone = 7;
    case Corporate = 8;

    public function name(): string
    {
        return match ($this) {
            self::MenOnly => __('Men Only'),
            self::GayWoman => __('Gay Woman'),
            self::GayMen => __('Gay Men'),
            self::Couple => __('Couple'),
            self::WomenOnly => __('Women Only'),
            self::Single => __('Single'),
            self::Anyone => __('Anyone'),
            self::Corporate => __('Corporate'),
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::MenOnly => asset('assets/images/icons-aimed-for/mens-only.png'),
            self::GayWoman => asset('assets/images/icons-aimed-for/gay-woman.png'),
            self::GayMen => asset('assets/images/icons-aimed-for/gay-men.png'),
            self::Couple => asset('assets/images/icons-aimed-for/couple.png'),
            self::WomenOnly => asset('assets/images/icons-aimed-for/womens-only.png'),
            self::Single => asset('assets/images/icons-aimed-for/single.png'),
            self::Anyone => asset('assets/images/icons-aimed-for/people.png'),
            self::Corporate => asset('assets/images/icons-aimed-for/corporate.png'),
        };
    }
}
