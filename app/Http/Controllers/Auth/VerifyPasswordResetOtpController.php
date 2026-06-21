<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VerifyPasswordResetOtpController extends Controller
{
    /**
     * Display the password reset OTP view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('password_reset_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-password-reset-otp', ['email' => $email]);
    }

    /**
     * Verify the OTP and redirect to password reset page.
     */
    public function store(Request $request): RedirectResponse
    {
        $digits = $request->input('otp', []);
        $otpCode = is_array($digits) ? implode('', $digits) : (string) $digits;

        if (strlen($otpCode) !== 4 || ! ctype_digit($otpCode)) {
            throw ValidationException::withMessages([
                'otp' => 'Sila masukkan 4 angka kod OTP.',
            ]);
        }

        $email = $request->session()->get('password_reset_email');

        if (! $email) {
            throw ValidationException::withMessages([
                'otp' => 'Sesi telah tamat. Sila minta kod baharu.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $request->session()->forget('password_reset_email');

            throw ValidationException::withMessages([
                'otp' => 'Pengguna tidak dijumpai.',
            ]);
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

        $user->forceFill([
            'email_verification_otp' => null,
            'email_verification_otp_sent_at' => null,
        ])->save();

        $request->session()->forget('password_reset_email');

        $token = Password::broker()->createToken($user);

        return redirect()->route('password.reset', ['token' => $token, 'email' => $user->email]);
    }
}
