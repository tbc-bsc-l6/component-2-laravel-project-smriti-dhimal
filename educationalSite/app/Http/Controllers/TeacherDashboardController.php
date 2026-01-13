<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    // Show teacher dashboard with assigned modules
    public function index()
    {
        $assignedModules = Module::where('teacher_id', Auth::id())
            ->with('users') // eager load students
            ->get();

        return view('Dashboard.teacher', compact('assignedModules'));
    }

    // Set student result (PASS/FAIL)
    public function setStudentResult(Request $request, $moduleId, $studentId)
    {
        $request->validate([
            'result' => 'required|in:PASS,FAIL',
        ]);

        $module = Module::where('teacher_id', Auth::id())->findOrFail($moduleId);

        // Correct way to update pivot
        $module->users()->updateExistingPivot($studentId, [
            'result' => $request->result,
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Student result updated successfully.');
    }
}
