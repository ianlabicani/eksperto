<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['expert', 'client', 'peso', 'admin'];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
