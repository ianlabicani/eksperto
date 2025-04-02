<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
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


        return redirect()->route('expert.profile.index')->with('status', 'address-updated');
    }
}
