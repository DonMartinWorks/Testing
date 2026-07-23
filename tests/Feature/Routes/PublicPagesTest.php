<?php

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

it('tests that there no console logs and errors', function () {
    $pages = visit(['/', '/login', '/register']);
    [$home, $login, $register] = $pages;

    $home->assertTitle('Welcome - Laravel');
    $login->assertTitle('Log in - Laravel');
    $register->assertTitle('Register - Laravel');

    $pages->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});
