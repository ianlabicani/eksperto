<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'house_number' => ['required', 'string'],
                'street' => ['required', 'string'],
                'barangay' => ['required', 'string'],
                'municipality' => ['required', 'string'],
                'province' => ['required', 'string'],
                'region' => ['required', 'string'],
                'zip_code' => ['required', 'string'],
            ]);

            $user = $request->user();
            $user->address()->updateOrCreate([], $validated);

            return redirect()->route('expert.profile.index')
                ->with('success', 'Address information has been successfully updated.');
        } catch (Exception $e) {
            Log::error('Address update error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred while updating your address. Please try again.')
                ->withInput();
        }
    }
}
