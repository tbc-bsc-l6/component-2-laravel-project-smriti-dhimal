<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\OldStudentDashboardController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/homepage', function (){
    return view('homepage');
});

Route::get('/about', function (){
    return view('about');
});

Route::get('/contact', function (){
    return view('contact');
});

Route::post('/contact-send', function (){
    return redirect()->route('contact.thankyou');
})->name('contact.send');

Route::get('/contact-thankyou', function (){
    return view('contact-thankyou');
})->name('contact.thankyou');

Route::middleware('auth')->group(function () {

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
        ->middleware('role:teacher')
        ->name('teacher.dashboard');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->middleware('role:student_or_oldstudent')
        ->name('student.dashboard');
    Route::get('/oldstudent/dashboard', [OldStudentDashboardController::class, 'index'])
        ->middleware('role:oldstudent')
        ->name('oldstudent.dashboard');

        Route::post('/admin/module/add', [AdminDashboardController::class, 'addModule'])
        ->middleware('role:admin')
        ->name('admin.add.module');
    Route::post('/admin/module/toggle/{id}', [AdminDashboardController::class, 'toggleModuleAvailability'])
        ->middleware('role:admin')
        ->name('admin.toggle.module');
    Route::post('/admin/teacher/create', [AdminDashboardController::class, 'createTeacher'])
        ->middleware('role:admin')
        ->name('admin.create.teacher');
    Route::post('/admin/teacher/assign', [AdminDashboardController::class, 'assignTeacher'])
        ->middleware('role:admin')
        ->name('admin.assign.teacher');
    Route::post('/admin/teacher/remove/{id}', [AdminDashboardController::class, 'removeTeacher'])
        ->middleware('role:admin')
        ->name('admin.remove.teacher');
    Route::post('/admin/user/role/{userId}', [AdminDashboardController::class, 'changeUserRole'])
        ->middleware('role:admin')
        ->name('admin.change.role');
    Route::post('/admin/module/remove-student/{moduleId}/{studentId}', [AdminDashboardController::class, 'removeStudentFromModule'])
        ->middleware('role:admin')
        ->name('admin.remove.student.module');

    Route::post('/teacher/set-result/{moduleId}/{studentId}', [TeacherDashboardController::class, 'setStudentResult'])
        ->middleware('role:teacher')
        ->name('teacher.set.result');

    Route::post('/student/enroll/{moduleId}', [StudentDashboardController::class, 'enrollModule'])
        ->middleware('role:student_or_oldstudent')
        ->name('student.enroll.module');
});

require __DIR__.'/auth.php';

Route::get('/homepage', function (){
    return view('homepage');
});

Route::get('/about', function (){
    return view('about');
});

Route::get('/contact', function (){
    return view('contact');
});

Route::post('/contact-send', function (){
    return redirect()->route('contact.thankyou');
})->name('contact.send');

Route::get('/contact-thankyou', function (){
    return view('contact-thankyou');
})->name('contact.thankyou');