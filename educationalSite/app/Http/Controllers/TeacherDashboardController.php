<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $assignedModules = Module::where('teacher_id', auth()->id())
        ->with(['activeStudents', 'completedStudents'])
        ->get();

        return view('Dashboard.teacher', compact('assignedModules'));
    }

    public function setStudentResult(Request $request, $moduleId, $studentId)
    {
        $request->validate([
            'result' => 'required|in:PASS,FAIL'

        ]);

        $module = Module::where('teacher_id', auth()->id())
        ->findOrFail($moduleId);

        $module->users()->updateExistingPivot($studentId, [
            'result' =>$request->result,
            'completed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Student result updated successfully.');
    }
}
