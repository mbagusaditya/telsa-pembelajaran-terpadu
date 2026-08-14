<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginPostRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminLoginController extends Controller
{
    public function page()
    {
        return Inertia::render('auth/login');
    }

    public function login(AdminLoginPostRequest $request)
   {
       //
   }
}
