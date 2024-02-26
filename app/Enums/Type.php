<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Type: int
{
    use ToArray;

    case Group = 1;
    case Individual = 2;
    case Course = 3;
    case Retreat = 4;


    public function name(): string
    {
        return match ($this) {
            self::Group => __('Group'),
            self::Individual => __('Individual'),
            self::Course => __('Course'),
            self::Retreat => __('Retreat'),
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::Group => asset('assets/images/icons-type/group.png'),
            self::Individual => asset('assets/images/icons-type/individual.png'),
            self::Course => asset('assets/images/icons-type/course.png'),
            self::Retreat => asset('assets/images/icons-type/retreats.png'),
        };
    }
}
