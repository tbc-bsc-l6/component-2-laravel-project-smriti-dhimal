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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/header', function (){
    return view('header');
});

Route::get('/footer', function (){
    return view('footer');
});

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

