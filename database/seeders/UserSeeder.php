<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Expert User', 'email' => 'expert@example.com', 'role' => 'expert'],
            ['name' => 'Client User', 'email' => 'client@example.com', 'role' => 'client'],
            ['name' => 'PESO User', 'email' => 'peso@example.com', 'role' => 'peso'],
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'role' => 'admin'],
        ];

        foreach ($users as $userData) {
            $role = Role::where('name', $userData['role'])->firstOrFail();

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('11111111'),
            ]);

            $user->roles()->attach($role);
        }
    }
}
