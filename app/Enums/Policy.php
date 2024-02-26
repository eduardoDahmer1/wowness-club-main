<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Policy
{
    use ToArray;

    case Free;
    case Flexible;
    case Moderate;
    case Strict;

    public function name(): string
    {
        return match ($this) {
            self::Free => __('Free'),
            self::Flexible => __('Flexible'),
            self::Moderate => __('Moderate'),
            self::Strict => __('Strict'),
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::Free => __('100% refund for cancellation up to 24 hours before the service start date. Refunds will be processed within 15 days.'),

            self::Flexible => __('100% refund for cancellation up to 7 days before the service start date. 50% refund for cancellation up to 24 hours before the service start date. 0% refund for cancellation less than 24 hours before the service start date. Refunds will be processed within 15 days.'),

            self::Moderate => __('100% refund for cancellation up to 15 days before the service start date. 50% refund for cancellation up to 7 days before the service start date. 0% refund for cancellation from 0 to 6 days before the service start date. Refunds will be processed within 15 days.'),

            self::Strict => __('100% refund for cancellation 30+ days before the service start date. 50% refund for cancellation from 15 to 29 days before the service start date. 0% refund for cancellation from 0 to 14 days before the service start date. Refunds will be processed within 15 days.'),
        };
    }
}
