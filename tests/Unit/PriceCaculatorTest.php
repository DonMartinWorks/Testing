<?php

describe("PriceCalculator - Percentage Discount", function () {
    it('applies percentage discount', function () {
        $calc = new \App\Services\PriceCalculator();

        expect($calc->applyPercentageDiscount(100, 20))
            ->toBe(80.0);
    });

    it('round discounted price', function () {
        $calc = new \App\Services\PriceCalculator();

        expect($calc->applyPercentageDiscount(100, 12.345)) # 87.655
            ->toBe(87.66);
    });
});
