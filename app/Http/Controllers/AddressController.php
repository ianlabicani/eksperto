<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function update(Request $request)
    {

        $validated = $request->validate([
            'house_number' => ['required', 'string'],
            'street' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'municipality' => ['required', 'string'],
            'province' => ['required', 'string'],
            'zip_code' => ['required', 'string'],
        ]);

        $user = $request->user();

        $user->address()->updateOrCreate([], $validated);


        return redirect()->route('profile.edit')->with('status', 'address-updated');
    }
}
