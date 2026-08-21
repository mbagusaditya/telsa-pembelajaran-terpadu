<?php

namespace App\Enums;

use App\Enums\Concerns\HasInertiaOptions;

enum UserRole: string
{
    use HasInertiaOptions;

    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';
}
