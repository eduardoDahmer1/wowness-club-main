<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Method: int
{
    use ToArray;

    case Online = 1;
    case InPerson = 2;

    public function name(): string
    {
        return match ($this) {
            self::Online => __('Online'),
            self::InPerson => __('In-Person'),
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::Online => asset('assets/images/icons-method/globe.png'),
            self::InPerson => asset('assets/images/icons-method/person.png'),
        };
    }
}
