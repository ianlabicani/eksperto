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
        $user = Auth::user();

        // Check if the profile is incomplete
        if ($user && !$this->isProfileComplete($user)) {
            return redirect()->route('profile.edit')->with('warning', 'Please complete your profile before proceeding.');
        }

        return $next($request);
    }

    /**
     * Determine if the user's profile is complete.
     */
    private function isProfileComplete($user)
    {
        return $user->profile()->exists() && $user->contacts()->exists() && $user->address()->exists();
    }
}

