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
            ['module'=>'Nepali','teacher_id'=> 2, 'is_available'=> 1,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Maths','teacher_id'=> 2, 'is_available'=> 1,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Science','teacher_id'=> 3, 'is_available'=> 1,'created_at'=> now(),'updated_at'=> now()],
            ['module'=>'Social','teacher_id'=> 3, 'is_available'=> 1,'created_at'=> now(),'updated_at'=> now()],

        ]);
    }
}
