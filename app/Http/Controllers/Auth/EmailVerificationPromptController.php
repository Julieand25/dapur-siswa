<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
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

        return view('auth.verify-email', ['email' => $email]);
    }
}
