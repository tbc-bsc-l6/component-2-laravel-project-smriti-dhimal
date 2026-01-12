<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Use 'role' column instead of 'name'
        $adminRole = UserRole::where('role', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Admin role not found. Make sure UserRoleSeeder ran first.');
            return;
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'user_role_id' => $adminRole->id,
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
