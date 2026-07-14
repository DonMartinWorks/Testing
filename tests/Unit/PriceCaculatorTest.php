<?php

use App\Services\PriceCalculator;

beforeEach(function () {
    $this->calc = new PriceCalculator();
});

describe("PriceCalculator - Percentage Discount", function () {
    it('applies percentage discount', function () {
        expect($this->calc->applyPercentageDiscount(100, 20))
            ->toBe(80.0);
    });

    it('round discounted price', function () {
        expect($this->calc->applyPercentageDiscount(100, 12.345)) # 87.655
            ->toBe(87.66);
    });
});

describe("PriceCalculator - Fixed Discount", function () {
    it('applies fixed discount', function () {
        expect($this->calc->applyFixedDiscount(100, 20))
            ->toBe(80.0);
    });

    it('never returns a negative price', function () {
        expect($this->calc->applyFixedDiscount(50, 100))
            ->toBe(0.00);
    });

    it('throws for negative fixed amount', function () {
        expect(fn() => $this->calc->applyFixedDiscount(100, -10))
            ->toThrow(InvalidArgumentException::class);
    });
});


describe("PriceCalculator - Add Tax & Final Price", function () {
    it('adds tax to the price', function () {
        expect($this->calc->addTax(100, 21))
            ->toBe(121.00);
    });

    it('rounds taxed price', function () {
        expect($this->calc->addTax(100.12345, 21))
            ->toBe(121.15);
    });

    it('calculates final price with discount and tax', function () {
        expect($this->calc->finalPrice(100, 10, 21))
            ->toBe(108.9);
    });
});
