<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('expert.profile.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['date'],
            'sex' => ['required', 'string']
        ]);

        $user->profile()->updateOrCreate(['user_id' => $user->id], $validated);

        return Redirect::route('expert.profile.index')->with('status', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the disk to use (default to 's3' or 'public')
        $disk = env('FILESYSTEM_DISK', 'public');

        // Store the new image
        $path = $request->file('photo')->store('uploads', $disk);

        $user = $request->user();
        $profile = $user->profile;

        // Delete old photo if exists
        if ($profile->url) {
            $oldKey = null;

            if ($disk === 's3') {
                // S3 URL: extract the key from the full URL
                $parsed = parse_url($profile->url);
                $oldKey = ltrim($parsed['path'], '/');
            } else {
                // Local/public storage: remove storage URL prefix
                $baseUrl = Storage::disk($disk)->url('/');
                $oldKey = Str::after($profile->url, $baseUrl);
            }

            // Delete the old file from disk (if exists)
            if ($oldKey) {
                Storage::disk($disk)->delete($oldKey);
            }
        }

        // Save the new photo URL or relative path
        if ($disk === 's3') {
            // For S3, save the full URL
            $profile->url = Storage::disk($disk)->url($path);
        } else {
            // For local storage, store the relative path (e.g., 'storage/uploads/filename.jpg')
            $profile->url = 'storage/' . $path;
        }

        $profile->save();

        return Redirect::route('expert.profile.index')->with('status', 'Profile photo updated');
    }

}
