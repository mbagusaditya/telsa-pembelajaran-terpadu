<?php

namespace App\Enums;

use App\Enums\Concerns\HasInertiaOptions;

enum Gender: string
{
    use HasInertiaOptions;

    case Male = 'male';
    case Female = 'female';
}
