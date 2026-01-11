<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_role_id' => 1,
            'email_verified_at' => now(),
        ]);

        for ($i = 1; $i <=2; $i++){
            User::create([
                'name' => "Teacher User {$i}",
                'email' => "teacher{$i}@gmail.com",
                'password' => Hash::make('password'),
                'user_role_id' => 2,
                'email_verified_at' =>now(),
            ]);
        }

        for ($i = 1; $i <=5; $i++){
            User::create([
                'name' => "Student User {$i}",
                'email' => "Student{$i}@gmail.com",
                'password' => Hash::make('password'),
                'user_role_id' => 3,
                'email_verified_at' =>now(),
            ]);
            }

            for ($i = 1; $i <=2; $i++){
            User::create([
                'name' => "Old Student User {$i}",
                'email' => "oldstudent{$i}@gmail.com",
                'password' => Hash::make('password'),
                'user_role_id' => 4,
                'email_verified_at' =>now(),
            ]);
        }
    }
}