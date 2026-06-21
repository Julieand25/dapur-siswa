<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $email = $request->session()->get('verification_email');

        if (! $email) {
            return redirect()->route('login');
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $request->session()->forget('verification_email');

            return redirect()->route('login');
        }

        if ($user->hasVerifiedEmail()) {
            $request->session()->forget('verification_email');

            return redirect()->route('login');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'otp-sent');
    }
}
