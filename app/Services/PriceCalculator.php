<?php

namespace App\Services;

use InvalidArgumentException;

class PriceCalculator
{
    public function applyPercentageDiscount(float $price, float $percent): float
    {
        if ($percent < 0 || $percent > 100) {
            throw new InvalidArgumentException('Invalid discount percent');
        }

        return round($price - ($price * $percent / 100), 2);
    }

    public function applyFixedDiscount(float $price, float $amount): float
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Invalid discount amount');
        }

        return max(0, round($price - $amount, 2));
    }

    public function addTax(float $price, float $taxPercent): float
    {
        return round($price + ($price * $taxPercent / 100), 2);
    }

    public function finalPrice(float $price, float $discountPercent, float $taxPercent): float
    {
        $afterDiscount = $this->applyPercentageDiscount($price, $discountPercent);

        return $this->addTax($afterDiscount, $taxPercent);
    }
}
