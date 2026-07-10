<?php

use App\Models\User;

test('checks that the value is true', function () {
    // $this->assertTrue(true);

    expect("Value")
        ->toBeString()
        ->toContain('V')
        ->not->toContain('v')
        ->not->ToBeInt();

    expect([1, 2, 3])
        ->toBeArray()
        ->toContain(2)
        ->toHaveCount(3);

    expect([1, 2, 3])
        ->toHaveCount(3)
        ->sequence(
            fn($value) => $value->ToBe(1),
            fn($value) => $value->ToBe(2),
            fn($value) => $value->ToBe(3),
        );

    $user = new User(['first_name' => 'Matt Damon']);

    expect($user)->toBeInstanceOf(User::class);
    expect([$user])->toContainOnlyInstancesOf(User::class);
});
