<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StudentLoginPostRequest;
use App\Services\Auth\LoginService;
use Inertia\Inertia;

class StudentLoginController extends Controller
{
    public function page()
    {
        return Inertia::render('auth/login/student');
    }

    public function login(StudentLoginPostRequest $request, LoginService $loginService)
    {
        $credentials = $request->validated();

        if (! $loginService->loginAsStudent($credentials)) {
            Inertia::flash('toast', [
                'message' => 'NIS atau Password salah!',
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
