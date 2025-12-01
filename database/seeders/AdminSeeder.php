<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@pendaftaran.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create a test user
        User::firstOrCreate(
            ['email' => 'user@pendaftaran.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
