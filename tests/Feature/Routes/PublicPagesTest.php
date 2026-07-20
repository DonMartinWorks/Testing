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

it('tests that mobile menu works', function () {
    $password = 'password123';

    $user = User::factory()->create([
        'password' => Hash::make($password),
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
        'two_factor_confirmed_at' => null,
    ]);

    visit('/login')
        ->on()->mobile()
        ->type('email', $user->email)
        ->type('password', $password)
        ->press('Log in')
        ->assertPathIs('/dashboard')
        ->press('[data-slot=sidebar-trigger]')
        ->assertVisible('Laravel Starter Kit')
        ->screenshot();
});

it('tests that there no console logs and errors', function () {
    $pages = visit(['/', '/login', '/register']);
    [$home, $login, $register] = $pages;

    $home->assertTitle('Welcome - Laravel');
    $login->assertTitle('Log in - Laravel');
    $register->assertTitle('Register - Laravel');

    $pages->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});
