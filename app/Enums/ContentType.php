<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum ContentType: int
{
    use ToArray;

    case Classes = 1;
    case Course = 2;
    case Talks = 3;

    public function name(): string
    {
        return match ($this) {
            self::Classes => __('Classes'),
            self::Course => __('Course'),
            self::Talks => __('Talks'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Classes => asset('assets/images/icons-contenttype/classes.jpeg'),
            self::Course => asset('assets/images/icons-contenttype/course.png'),
            self::Talks => asset('assets/images/icons-contenttype/talks.png'),
        };
    }
}
