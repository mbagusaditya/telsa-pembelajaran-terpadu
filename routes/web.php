<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('index');
});

Route::middleware(['guest'])->group(function () {
    # =============
    # AUTH ROUTES
    # =============
    Route::get('/auth/login', [LoginController::class, 'page'])->name('auth.login');
});
