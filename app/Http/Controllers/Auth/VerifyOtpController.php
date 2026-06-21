<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class VerifyOtpController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $digits = $request->input('otp', []);
        $otpCode = is_array($digits) ? implode('', $digits) : (string) $digits;

        if (strlen($otpCode) !== 4 || ! ctype_digit($otpCode)) {
            throw ValidationException::withMessages([
                'otp' => 'Sila masukkan 4 angka kod OTP.',
            ]);
        }

        $email = $request->session()->get('verification_email');

        if (! $email) {
            throw ValidationException::withMessages([
                'otp' => 'Sesi telah tamat. Sila log masuk semula.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $request->session()->forget('verification_email');

            throw ValidationException::withMessages([
                'otp' => 'Pengguna tidak dijumpai.',
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            $request->session()->forget('verification_email');

            return redirect()->route('login');
        }

        if (! $user->email_verification_otp) {
            throw ValidationException::withMessages([
                'otp' => 'Sila minta kod OTP baharu terlebih dahulu.',
            ]);
        }

        $expiry = now()->subMinutes(Config::get('auth.verification.otp_expire', 10));

        if ($user->email_verification_otp_sent_at && $user->email_verification_otp_sent_at->lt($expiry)) {
            throw ValidationException::withMessages([
                'otp' => 'Kod OTP telah tamat tempoh. Sila minta kod baharu.',
            ]);
        }

        if ($user->email_verification_otp !== $otpCode) {
            throw ValidationException::withMessages([
                'otp' => 'Kod OTP tidak sah.',
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $user->forceFill([
            'email_verification_otp' => null,
            'email_verification_otp_sent_at' => null,
        ])->save();

        $request->session()->forget('verification_email');

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
