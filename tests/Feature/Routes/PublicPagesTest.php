<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;

it('shows welcome page', function () {
    $response = visit('/');

    $response->assertSee("Laravel");
});

it('shows the login page', function () {
    visit('/login')
        ->assertSee('Log in')
        ->assertDontSee('Dashboard');

    visit('/')
        ->click('Log in')
        ->assertSee('Log in')
        ->assertPathIs('/login');
});

it('tests that login works', function () {
    $password = 'password123';

    $user = User::factory()->create([
        'password' => Hash::make($password),
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
        'two_factor_confirmed_at' => null,
    ]);

    visit('/login')
        ->type('email', $user->email)
        ->type('password', $password)
        ->press('Log in')
        ->assertPathIs('/dashboard')
        ->screenshot();
});
