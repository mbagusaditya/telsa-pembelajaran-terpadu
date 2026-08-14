<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StudentLoginPostRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentLoginController extends Controller
{
    public function page()
    {
        return Inertia::render('auth/login');
    }

    public function login(StudentLoginPostRequest $request)
    {
        //
    }
}
