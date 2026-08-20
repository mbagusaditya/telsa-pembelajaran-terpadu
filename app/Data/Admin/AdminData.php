<?php

namespace App\Data\Admin;

use App\Data\User\UserData;
use App\Enums\Gender;
use App\Enums\StudentStatus;
use App\Models\Admin;
use App\Models\Student;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AdminData extends Data
{
    public function __construct(
        // 1. Identitas Utama & Identifier
        public string $id,
        public string $username,

        // 2. Relasi (Lazy::whenLoaded menggantikan whenLoaded)
        public Lazy|UserData|null $user,
        public string $user_id,

        // 3. Timestamps & Audit Info
        public ?string $created_at,
        public ?string $updated_at,
        public ?string $created_at_formatted,
    ) {}

    /**
     * Mapping data dari Model Eloquent ke Data Object
     */
    public static function fromModel(Admin $admin): self
    {
        return new self(
            id: $admin->id,
            username: $admin->username,

            // Relasi lazy-loaded (hanya di-load jika sudah di-eager load)
            user: Lazy::whenLoaded('user', $admin, fn () => $admin->user ? UserData::from($admin->user) : null),
            user_id: $admin->user_id,

            created_at: $admin->created_at?->toIso8601String(),
            updated_at: $admin->updated_at?->toIso8601String(),
            created_at_formatted: $admin->created_at?->translatedFormat('d M Y H:i'),
        );
    }
}
