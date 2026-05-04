<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update default admin user
        // Password can be hashed automatically if User model has: 'password' => 'hashed'
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => 'password123',
                'role' => 'admin',
            ]
        );

        // Create or update default support agent user
        // Password can be hashed automatically if User model has: 'password' => 'hashed'
        User::updateOrCreate(
            ['email' => 'agent@example.com'],
            [
                'name' => 'John - Support Agent',
                'password' => 'agentpassword',
                'role' => 'agent',
            ]
        );
    }
}