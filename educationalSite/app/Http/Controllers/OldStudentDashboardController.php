<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OldStudentDashboardController extends Controller
{
    public function index()
    {
        $completedModules = auth()->user()
        ->completedModules()
        ->with('teacher')
        ->get();

        return view('Dashboard.oldstudent', compact('completedModules'));
    }
}
