<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\User;

class EnhancedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $teachers = User::factory()->teacher()->count(3)->create();

        $students = User::factory()->currentStudent()->count(15)->create();
        $oldStudents = User::factory()->oldStudent()->count(8)->create();

        $modules = Module::factory()->count(12)->withTeacher()->available()->create();
        $unavailableModules = Module::factory()->count(2)->unavailable()->create();

        foreach ($students as $student) {
            $enrollCount = rand(1, 3);
            $selectedModules = $modules->random($enrollCount);
            
            foreach ($selectedModules as $module) {
                if ($module->activeStudents()->count() < 10) {
                    $student->modules()->attach($module->id, [
                        'start_date' => now()->subDays(rand(1, 30)),
                    ]);
                }
            }
        }
            foreach ($oldStudents as $oldStudent) {
            $completedCount = rand(2, 4);
            $selectedModules = $modules->random($completedCount);
            
            foreach ($selectedModules as $module) {
                $oldStudent->modules()->attach($module->id, [
                    'start_date' => now()->subDays(rand(60, 180)),
                    'completed_at' => now()->subDays(rand(1, 30)),
                    'result' => rand(0, 1) ? 'PASS' : 'FAIL',
                ]);
            }
        }
        
        $this->command->info('Enhanced seeder completed successfully!');
    }
}