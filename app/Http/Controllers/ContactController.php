<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function update(Request $request)
    {

        if (!$request->has('contacts')) {
            return redirect()->route('profile.edit')->with('warning', 'Please provide at least one contact information.');
        }

        $validated = $request->validate([
            'contacts' => ['array'],
            'contacts.*.type' => ['required_with:contacts', 'in:phone_number,tel_number,email,link'],
            'contacts.*.value' => ['required_with:contacts', 'string'],
        ]);


        $user = $request->user();

        if ($user->contacts()->count() === 0 && count($validated['contacts']) === 0) {
            return redirect()->route('profile.edit')->with('status', 'contact-updated');
        }

        if (count($validated['contacts']) > 0) {
            $user->contacts()->delete();
            foreach ($validated['contacts'] as $contact) {
                $user->contacts()->create([
                    'type' => $contact['type'],
                    'value' => $contact['value'],
                ]);
            }
        }

        return redirect()->route('profile.edit')->with('status', 'contact-updated');
    }

}
