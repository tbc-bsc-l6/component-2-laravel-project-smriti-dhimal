<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'teacher', 'student', 'oldstudent'];

        foreach ($roles as $role) {
            // Use the correct column name in your table
            UserRole::firstOrCreate(['role' => $role]);
        }

        $this->command->info("User roles seeded successfully.");
    }
}
