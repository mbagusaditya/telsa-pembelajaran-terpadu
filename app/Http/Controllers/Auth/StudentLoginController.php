<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StudentLoginPostRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class StudentLoginController extends Controller
{
    public function page()
    {
        return Inertia::render('auth/login/student');
    }

    public function login(StudentLoginPostRequest $request)
    {
        $credentials = $request->validated();

        $student = Student::query()
            ->with(['user'])
            ->where('nis', $credentials['nis'])
            ->first(['id', 'nis', 'user_id']);

        if (!($student && $student->user && Hash::check($credentials['password'], $student->user->password))) {
            Inertia::flash('toast', [
                'message' => 'NIS atau Password salah!',
                'type' => 'error',
                'code' => 401
            ]);

            return back();
        }

        Auth::guard('web')->login($student->user);
        $request->session()->regenerate();

        Inertia::flash('toast', [
            'message' => 'Login berhasil!',
            'type' => 'success',
            'code' => 200
        ]);

        return redirect()->route('dashboard');
    }
}
