<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Get all users
    $users = User::all();

    foreach ($users as $user) {
      // Skip if the user already has contacts
      if ($user->contacts()->count() > 0) {
        continue;
      }

      // Add email contact (using their account email)
      $user->contacts()->create([
        'type' => 'email',
        'value' => $user->email
      ]);

      // Add phone number (random)
      $user->contacts()->create([
        'type' => 'phone_number',
        'value' => '09' . rand(100000000, 999999999) // Philippines mobile number format
      ]);

      // For some users, add telephone number
      if (rand(0, 1) === 1) {
        $user->contacts()->create([
          'type' => 'tel_number',
          'value' => '(0' . rand(2, 8) . ') ' . rand(100, 999) . '-' . rand(1000, 9999)
        ]);
      }

      // For some users, add a website/social link
      if (rand(0, 1) === 1) {
        $domains = ['facebook.com', 'linkedin.com', 'twitter.com', 'instagram.com', 'github.com'];
        $domain = $domains[array_rand($domains)];
        $username = strtolower(str_replace(' ', '.', $user->name));

        $user->contacts()->create([
          'type' => 'link',
          'value' => "https://{$domain}/{$username}"
        ]);
      }
    }
  }
}
