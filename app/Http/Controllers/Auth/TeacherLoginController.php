<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TeacherLoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TeacherLoginController extends Controller
{
    public function page()
    {
        return Inertia::render('auth/login/teacher');
    }

    public function login(TeacherLoginPostRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::guard('web')->attempt($credentials)) {
            Inertia::flash('toast', [
                'message' => 'Email atau Password salah!',
                'type' => 'error',
                'code' => 401,
            ]);

            return back();
        }

        $request->session()->regenerate();

        Inertia::flash('toast', [
            'message' => 'Login berhasil!',
            'type' => 'success',
            'code' => 200,
        ]);

        return redirect()->route('dashboard');
    }
}
