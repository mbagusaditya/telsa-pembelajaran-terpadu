<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\TeacherLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('index');
});

// =============
// AUTH ROUTES
// =============
Route::middleware(['guest'])->group(function () {
    // =============
    // STUDENT ROUTES
    // =============
    Route::get('/auth/login', [StudentLoginController::class, 'page'])->name('auth.login');
    Route::post('/auth/login', [StudentLoginController::class, 'login'])->name('auth.login.post');

    // =============
    // TEACHER ROUTES
    // =============
    Route::get('/auth/login/teacher', [TeacherLoginController::class, 'page'])->name('auth.login.teacher');
    Route::post('/auth/login/teacher', [TeacherLoginController::class, 'login'])->name('auth.login.teacher.post');

    // =============
    // ADMIN ROUTES
    // =============
    Route::get('/auth/login/admin', [AdminLoginController::class, 'page'])->name('auth.login.admin');
    Route::post('/auth/login/admin', [AdminLoginController::class, 'login'])->name('auth.login.admin.post');
});
