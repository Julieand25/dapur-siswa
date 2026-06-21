<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

test('reset password screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('reset password otp can be requested', function () {
    $user = User::factory()->create();

    $response = $this->post('/forgot-password', ['email' => $user->email]);

    $response->assertRedirect(route('password.reset.otp'));
    $response->assertSessionHas('password_reset_email', $user->email);
    expect($user->fresh()->email_verification_otp)->not->toBeNull();
});

test('reset password otp screen can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->withSession(['password_reset_email' => $user->email])
        ->get('/reset-password-otp');

    $response->assertStatus(200);
});

test('otp screen without session redirects to forgot password', function () {
    $response = $this->get('/reset-password-otp');

    $response->assertRedirect(route('password.request'));
});

test('password reset otp can be verified', function () {
    $user = User::factory()->create([
        'email_verification_otp' => '5678',
        'email_verification_otp_sent_at' => now(),
    ]);

    $response = $this->withSession(['password_reset_email' => $user->email])
        ->post('/reset-password-otp', [
            'otp' => ['5', '6', '7', '8'],
        ]);

    $response->assertRedirect();
    $redirectUrl = $response->getTargetUrl();
    expect($redirectUrl)->toContain('/reset-password/');
    $response->assertSessionMissing('password_reset_email');
    expect($user->fresh()->email_verification_otp)->toBeNull();
});

test('password reset screen with token can be rendered', function () {
    $user = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $response = $this->get(route('password.reset', ['token' => $token, 'email' => $user->email]));

    $response->assertStatus(200);
});

test('password can be reset with valid token', function () {
    $user = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $response = $this->post('/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));

    expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
});
