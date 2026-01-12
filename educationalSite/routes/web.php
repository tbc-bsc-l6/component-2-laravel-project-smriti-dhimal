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

// Generic dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Dashboard routes (these will be protected by auth and gates)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard routes
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/oldstudent/dashboard', [OldStudentDashboardController::class, 'index'])->name('oldstudent.dashboard');
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