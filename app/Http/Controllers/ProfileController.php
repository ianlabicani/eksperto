<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->profile ?? new Profile();
        $contacts = $user->contacts ?? [];
        $address = $user->address ?? new Address();

        return view('profile.edit', compact('user', 'profile', 'contacts', 'address'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date'],
            'sex' => ['required', 'string']
        ]);

        $user->save();

        // Prepare profile data
        $profileData = array_merge($validated, [
            'age' => isset($validated['date_of_birth'])
                ? \Carbon\Carbon::parse($validated['date_of_birth'])->age
                : null,
        ]);

        // Update or create the associated profile
        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function show(Request $request, Profile $profile)
    {
        $user = $request->user();

        // Eager load related data to avoid N+1 queries
        $profile->load('user.address', 'user.contacts', 'user.educationalBackgrounds');

        // Simplified shell determination using match (PHP 8.0+)
        $shell = match (true) {
            $user->isClient() => 'client.shell',
            $user->isExpert() => 'expert.shell',
            $user->isPeso() => 'peso.shell',
            default => 'default.shell',
        };

        $address = $profile->user->address;
        $contacts = $profile->user->contacts;
        $educationalBackgrounds = $profile->user->educationalBackgrounds;

        return view('profile.show', compact('profile', 'shell', 'user', 'address', 'contacts', 'educationalBackgrounds'));
    }


    /**
     * Delete the user's account and their profile.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Delete the profile first to maintain referential integrity
        $user->profile()->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
