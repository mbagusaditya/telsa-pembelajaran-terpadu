<?php

namespace App\Services\Auth;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function loginAsStudent(array $credentials): bool
    {
        $student = Student::query()
            ->with(['user'])
            ->where('nis', $credentials['nis'])
            ->first(['id', 'nis', 'user_id']);

        if (
            ! $student ||
            ! $student->user ||
            ! Hash::check(
                $credentials['password'],
                $student->user->password,
            )
        ) {
            return false;
        }

        Auth::guard('web')->login($student->user, $credentials['remember'] ?? false);

        return true;
    }

    public function loginAsStaff(array $credentials): bool
    {
        return Auth::guard('web')->attempt($credentials, $credentials['remember'] ?? false);
    }
}
