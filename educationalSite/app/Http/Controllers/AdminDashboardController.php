<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\UserRole;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $modules = Module::with('teacher')->get();
        $teachers = User::where('user_role_id', 2)->get();
        $students = User::whereIn('user_role_id', [3, 4])->get();
        $userRoles = UserRole::all();

        return view('admin.dashboard', compact('modules', 'teachers', 'students', 'userRoles'));
    }

    public function addModule(Request $request)
    {
        $request->validate([
            'module' => 'required|string|unique:modules,module'

        ]);

        Module::create([
            'module' => $request->module,
            'available' => true
        ]);

        return redirect()->back()->with('success', 'Module added successfully.');
    }

    public function toogleModuleAvailability($id)
    {
        $module = Module::findOrFail($id);
        $module->available = !$module->available;
        $module->save();

        return redirect()->back()->with('success', 'Module availability updated.');
    }

    public function createTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
         
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_role_id' => 2 //Teacher
        ]);
        return redirect()->back()->with('success', 'Teacher created successfully.');
    }

    public function assignTeacher(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:users,id'
        ]);

        $module = Module::findOrFail($request->module_id);
        $module->teacher_id = $request->teacher_id;
        $module->save();

        return redirect()->back()->with('success', 'Teacher assigned to module successfully.');

    }

    public function removeStudentFromModule($moduleId, $studentId)
    {
        $module = Module::findOrFail($moduleId);
        $module->users()->detach($studentId);

        return redirect()->back()->with('success', 'Student removed from module successfully.');
    }

    public function changeUserRole(Request $request, $userId)
    {
        $request->validate([
            'user_role_id' => 'required|exists:user_roles,id'
        ]);

        $user = User::findOrFail($userId);
        $user->user_role_id = $request->user_role_id;
        $user->save();

        return redirect()->back()->with('success', 'User role changes successfully.');
    }

    public function removeTeacher($id)
    {
        $teacher = User::findOrFail($id);

        Module::where('teacher_id', $id)->update(['teacher_id' => null]);
        $teacher->delete();

        return redirect()-back()->with('success', 'Teacher removed successfully.');
    }
}
