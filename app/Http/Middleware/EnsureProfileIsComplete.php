<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Check if the profile is incomplete
        if ($user && !$user->isProfileComplete()) {
            // Store profile incomplete status in session for display purposes
            $request->session()->flash('profile_incomplete', true);

            $incompleteFields = $user->getIncompleteProfileFields();
            $request->session()->flash('incomplete_fields', $incompleteFields);

            if ($user->roles()->first()->name === 'expert') {
                return redirect()->route('expert.profile.index')->with('warning', 'Please complete your profile before proceeding.');
            }

            if ($user->roles()->first()->name === 'client') {
                return redirect()->route('client.profile.index')->with('warning', 'Please complete your profile before proceeding.');
            }

            return redirect()->route('welcome')->with('warning', 'Please complete your profile before proceeding.');
        }

        return $next($request);
    }

}

