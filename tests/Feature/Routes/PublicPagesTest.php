<?php

use function Pest\Laravel\get;

it('shows welcome page', function () {
    $response = get('/');

    $response->assertStatus(200);
});

it('shows the login page', function () {
    get('/login')
        ->assertStatus(200)
        ->assertSee('Login')
        ->assertDontSee('Dashboard');
});
