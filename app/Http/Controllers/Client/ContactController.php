<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    if (!$request->has('contacts')) {
      return Redirect::route('client.profile.index')
        ->with('warning', 'Please provide at least one contact information.');
    }

    $validated = $request->validate([
      'contacts' => ['array'],
      'contacts.*.type' => ['required_with:contacts', 'in:phone_number,tel_number,email,link'],
      'contacts.*.value' => ['required_with:contacts', 'string'],
    ]);

    $user = $request->user();

    if ($user->contacts()->count() === 0 && count($validated['contacts']) === 0) {
      return Redirect::route('client.profile.index')->with('status', 'No changes made to contacts');
    }

    if (count($validated['contacts']) > 0) {
      // Delete existing contacts and create new ones
      $user->contacts()->delete();

      foreach ($validated['contacts'] as $contact) {
        $user->contacts()->create([
          'type' => $contact['type'],
          'value' => $contact['value'],
        ]);
      }
    }

    return Redirect::route('client.profile.index')->with('status', 'Contact information updated successfully');
  }
}
