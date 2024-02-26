<?php
namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Cost: int
{
    use ToArray;

    case Free = 1;
    case Paid = 2;

    public function name(): string
    {
        return match ($this) {
            self::Free => __('Free'),
            self::Paid => __('Paid'),
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Free => asset('assets/images/icons-cost/free.jpeg'),
            self::Paid => asset('assets/images/icons-cost/paid.jpeg')
        };
    }
}
