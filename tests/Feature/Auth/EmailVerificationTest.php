<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;

test('email verification screen can be rendered', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified with valid otp', function () {
    $user = User::factory()->unverified()->create([
        'email_verification_otp' => '1234',
        'email_verification_otp_sent_at' => now(),
    ]);

    Event::fake();

    $response = $this->actingAs($user)->post('/verify-email', [
        'otp' => ['1', '2', '3', '4'],
    ]);

    Event::assertDispatched(Verified::class);
    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('email is not verified with invalid otp', function () {
    $user = User::factory()->unverified()->create([
        'email_verification_otp' => '1234',
        'email_verification_otp_sent_at' => now(),
    ]);

    $response = $this->actingAs($user)->post('/verify-email', [
        'otp' => ['9', '9', '9', '9'],
    ]);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
    $response->assertSessionHasErrors('otp');
});

test('email is not verified with expired otp', function () {
    Config::set('auth.verification.otp_expire', 10);

    $user = User::factory()->unverified()->create([
        'email_verification_otp' => '1234',
        'email_verification_otp_sent_at' => now()->subMinutes(15),
    ]);

    $response = $this->actingAs($user)->post('/verify-email', [
        'otp' => ['1', '2', '3', '4'],
    ]);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
    $response->assertSessionHasErrors('otp');
});

test('otp is cleared after successful verification', function () {
    $user = User::factory()->unverified()->create([
        'email_verification_otp' => '5678',
        'email_verification_otp_sent_at' => now(),
    ]);

    $this->actingAs($user)->post('/verify-email', [
        'otp' => ['5', '6', '7', '8'],
    ]);

    $fresh = $user->fresh();
    expect($fresh->email_verification_otp)->toBeNull();
    expect($fresh->email_verification_otp_sent_at)->toBeNull();
});

test('already verified user is redirected', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertRedirect(route('dashboard', absolute: false));
});
