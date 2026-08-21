<?php

namespace App\Enums;

use App\Enums\Concerns\HasInertiaOptions;

enum StudentStatus: string
{
    use HasInertiaOptions;

    case Active = 'active';
    case Graduated = 'graduated';
    case Transferred = 'transferred';
    case DroppedOut = 'dropped_out';
}
