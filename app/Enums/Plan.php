<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum Plan: int
{
    use ToArray;

    case Free = 1;
    case Standard = 2;
    case FoundingMember = 3;
    case Professional = 4;

    public function name(): string
    {
        return match ($this) {
            self::Free => __('Free'),
            self::Standard => __('Standard'),
            self::FoundingMember => __('Founding Member'),
            self::Professional => __('Professional'),
        };
    }

    public function stripeId(): string
    {
        return match ($this) {
            self::Free => __('prod_P8deDQUmA21WKx'),
            self::Standard => __('prod_P8dvd6W72etxXs'),
            self::FoundingMember => __('prod_P8dmriJ1MsR7y2'),
            self::Professional => __('prod_PVwV3ka42cZPh5'),
        };
    }

    public static function findByStripeId(string $stripeId): ?Plan
    {
        foreach (self::cases() as $case) {
            $enumInstance = self::from($case->value);
            if ($enumInstance->stripeId() === $stripeId) {
                return $enumInstance;
            }
        }

        return null;
    }

    public function fee(): float
    {
        return match ($this) {
            self::Free => 0.15,
            self::Standard => 0.05,
            self::FoundingMember => 0,
            self::Professional => 0,
        };
    }

    public function contentFee(): float
    {
        return match ($this) {
            self::Free => 0.10,
            self::Standard => 0.10,
            self::Professional => 0.05,
            self::FoundingMember => 0,
        };
    }

    public function serviceFee(): float
    {
        return match ($this) {
            self::Free => 0.15,
            self::Standard => 0.10,
            self::Professional => 0.05,
            self::FoundingMember => 0,
        };
    }
}
