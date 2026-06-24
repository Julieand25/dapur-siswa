<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@upsi.edu.my',
        'phone' => '0123456789',
        'position' => 'Pensyarah',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect(route('verification.notice'));
    $response->assertSessionHas('verification_email', 'test@upsi.edu.my');
});
