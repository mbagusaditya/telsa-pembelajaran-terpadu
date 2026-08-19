<?php

namespace App\Data\User;

use Spatie\LaravelData\Attributes\Hidden;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $id,
        public string $email,

        #[Hidden()]
        public string $password,
        public ?string $avatar,
    ) {}
}
