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
        DB::table('users')->insert([
            
            'name'=>'Admin User',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'user_role_id'=>1,
            'created_at'=> now(),
            'updated_at'=>now(),
        ]);

        DB::table('users')->insert([
            [
                'name'=>'Teacher 1',
                'email'=>'teacher1@gmail.com',
                'password'=>Hash::make('password'),
                'user_role_id'=>2,
                'created_at'=> now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'Teacher 2',
                'email'=>'teacher2@gmail.com',
                'password'=>Hash::make('password'),
                'user_role_id'=>2,
                'created_at'=> now(),
                'updated_at'=>now(),
            ],
        ]);
        $students=[];
        for($i=1;$i<=5;$i++){
            $students[]=[
                'name'=>'Student User',
                'email'=>'student@gmail.com',
                'password'=>Hash::make('password'),
                'user_role_id'=>3,
                'created_at'=> now(),
                'updated_at'=>now(),
            ];
        }
        DB::table('users')->insert($students);
         
        $oldstudents=[];
        for($i=1;$i<=2;$i++){
            $oldstudents[]=[
                'name'=>'Old Student User',
                'email'=>'oldstudent@gmail.com',
                'password'=>Hash::make('password'),
                'user_role_id'=>4,
                'created_at'=> now(),
                'updated_at'=>now(),
            ];
        }
        DB::table('users')->insert($oldstudents);
    }
}
