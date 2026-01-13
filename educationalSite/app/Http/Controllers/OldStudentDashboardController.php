<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OldStudentDashboardController extends Controller
{
    public function index()
    {
        $completedModule = auth()->user()
        ->completedModules()
        ->with('teacher')
        ->get();

        return view('oldstudent.dashboard', compact('completedModules'));
    }
}
