<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')-> insert([
            ['module'=>'Nepali','teacher_id'=> null, 'available'=> true,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Maths','teacher_id'=> null, 'available'=> true,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Science','teacher_id'=> null, 'available'=> true,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Social','teacher_id'=> null, 'available'=> true,'created_at'=> now(),'updated_at'=> now()],
        ]);
        $this->command->info('modules seeded successfully.');
    }
}