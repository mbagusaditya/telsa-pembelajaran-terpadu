<?php

namespace App\Data\User;

use App\Data\Admin\AdminData;
use App\Data\Student\StudentData;
use App\Models\User;
use Spatie\LaravelData\Attributes\Hidden;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public string $id,
        public string $email,

        #[Hidden()]
        public string $password,
        public ?string $avatar,
        public ?string $role,
        public Lazy|AdminData|StudentData|null $profile,
    ) {}

    public static function fromModel(User $user): self
    {
        $role = $user->getRoleNames()->first();

        return new self(
            id: $user->id,
            email: $user->email,
            password: $user->password,
            avatar: $user->avatar,
            role: $role,
            profile: match ($role) {
                'student' => Lazy::whenLoaded(
                    'student',
                    $user,
                    fn () => $user->student ? UserData::from($user->student) : null
                )->defaultIncluded(),

                'admin' => Lazy::whenLoaded(
                    'admin',
                    $user,
                    fn () => $user->admin ? AdminData::from($user->admin) : null
                )->defaultIncluded(),

                default => null,
            }
        );
    }
}
