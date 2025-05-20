<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('expert.profile.password.show', [
            'user' => $user
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            try {
                $request->user()->update([
                    'password' => Hash::make($validated['password']),
                ]);

                session()->flash('success', 'Your password has been updated successfully.');
                return back()->with('status', 'password-updated');
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to update password: ' . $e->getMessage());
                return back()->withErrors(['update_error' => 'An error occurred while updating your password.']);
            }
        } catch (ValidationException $e) {
            session()->flash('error', 'Password validation failed. Please check your inputs.');
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred.');
            return back()->withErrors(['unexpected_error' => 'An unexpected error occurred. Please try again.']);
        }
    }
}
