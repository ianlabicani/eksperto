<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->roles()->first()->name === 'client') {
                return redirect()->intended(route('client.dashboard', absolute: false));
            }

            if ($request->user()->roles()->first()->name === 'peso') {
                return redirect()->intended(route('peso.dashboard', absolute: false));
            }

            if ($request->user()->roles()->first()->name === 'expert') {
                return redirect()->intended(route('expert.dashboard', absolute: false));
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('welcome', absolute: false) . '?verified=1');
    }
}
