<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('user_roles')->insert([
            ['id' => 1, 'name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Teacher', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Current Student', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Old Student', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
