<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService {
    public function getAuthUser(): User | null
    {
        /** @var User|null $user */
        $user = Auth::guard('web')->user();

        if (!$user) {
            return null;
        }

        match ($user->getRoleNames()->first()) {
            'student' => $user->load('student'),
            'teacher' => $user->load('teacher'),
            'admin' => $user->load('admin'),
            default => null,
        };

        return $user;
    }
}
