<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        $disk = env('FILESYSTEM_DISK', 's3');

        // Store new photo in S3
        $path = $request->file('photo')->store('uploads', $disk);

        $user = $request->user();
        $profile = $user->profile;

        // Delete old image if exists
        if ($profile->url) {
            // Example stored URL:
            // https://eksperto-bucket.s3.ap-southeast-2.amazonaws.com/uploads/oldphoto.jpg

            $parsed = parse_url($profile->url);
            $oldKey = ltrim($parsed['path'], '/'); // removes the leading slash

            Storage::disk($disk)->delete($oldKey);
        }

        // Save new URL
        $profile->url = Storage::disk($disk)->url($path);
        $profile->save();

        return Redirect::route('expert.profile.index')->with('status', 'Profile photo updated');
    }



}
