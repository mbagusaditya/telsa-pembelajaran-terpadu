<?php

use App\Http\Controllers\Auth\StudentLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('index');
});

# =============
# AUTH ROUTES
# =============
Route::middleware(['guest'])->group(function () {
    # =============
    # STUDENT ROUTES
    # =============
    Route::get('/auth/login', [StudentLoginController::class, 'page'])->name('auth.login');
    Route::post('/auth/login', [StudentLoginController::class, 'login'])->name('auth.login.post');

    # =============
    # TEACHER ROUTES
    # =============
    Route::get('/auth/login', [StudentLoginController::class, 'page'])->name('auth.login');
    Route::post('/auth/login', [StudentLoginController::class, 'login'])->name('auth.login.post');

    # =============
    # ADMIN ROUTES
    # =============
    Route::get('/auth/login', [StudentLoginController::class, 'page'])->name('auth.login');
    Route::post('/auth/login', [StudentLoginController::class, 'login'])->name('auth.login.post');
});
