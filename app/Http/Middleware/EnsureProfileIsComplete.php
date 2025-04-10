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

            if ($user->roles()->first()->name === 'expert') {
                return redirect()->route('expert.profile.index')->with('warning', 'Please complete your profile before proceeding.');
            }


            return redirect()->route('welcome')->with('warning', 'Please complete your profile before proceeding.');
        }
        dd($user->roles()->first()->name);

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

