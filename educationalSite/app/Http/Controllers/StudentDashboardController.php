<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get student's active and completed modules
        $activeModules = $user->activeModules()->with('teacher')->get();
        $completedModules = $user->completedModules()->with('teacher')->get();
        
        // Get available modules for enrollment (max 4 active modules)
        $canEnroll = $activeModules->count() < 4;
        $availableModules = [];
        
        if ($canEnroll) {
            $availableModules = Module::where('available', true)
                ->whereDoesntHave('activeStudents', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where(function($query) {
                    $query->whereNull('teacher_id')
                        ->orWhereHas('activeStudents', function($q) {
                            $q->havingRaw('COUNT(*) < 10');
                        });
                })
                ->with('teacher')
                ->get();
        }

        return view('student.dashboard', compact('activeModules', 'completedModules', 'availableModules', 'canEnroll'));
    }

    public function enrollModule(Request $request, $moduleId)
    {
        $user = auth()->user();
        
        // Check if student can enroll (max 4 active modules)
        if ($user->activeModules()->count() >= 4) {
            return redirect()->back()->with('error', 'You cannot enroll in more than 4 modules at once.');
        }

        $module = Module::findOrFail($moduleId);

        // Check if module is available
        if (!$module->available) {
            return redirect()->back()->with('error', 'This module is not available for enrollment.');
        }

        // Check if module has space (max 10 students)
        if ($module->activeStudents()->count() >= 10) {
            return redirect()->back()->with('error', 'This module is full. No space available.');
        }

        // Check if already enrolled
        if ($user->activeModules()->where('module_id', $moduleId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this module.');
        }

        // Enroll student
        $user->modules()->attach($moduleId, [
            'start_date' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully enrolled in ' . $module->module . '!');
    }
}
