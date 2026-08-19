<?php

namespace App\Data\Student;

use App\Data\User\UserData;
use App\Enums\Gender;
use App\Enums\StudentStatus;
use App\Models\Student;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class StudentData extends Data
{
    public function __construct(
        // 1. Identitas Utama & Identifier
        public string $id,
        public string $name,
        public ?string $nis,
        public ?string $nisn,
        public ?string $nik,

        // 2. Data Kelahiran (Raw & Display Ready)
        public ?string $birth_place,
        public ?string $birth_date,
        public string $birth_info,
        public ?int $age,

        // 3. Status Akademik & Status Siswa
        public ?int $admission_year,
        public StudentStatus $status,
        public Gender $gender,

        // 4. Relasi (Lazy::whenLoaded menggantikan whenLoaded)
        public Lazy|UserData|null $user,
        public Lazy|UserData|null $creator,

        // 5. Timestamps & Audit Info
        public ?string $created_at,
        public ?string $updated_at,
        public ?string $created_at_formatted,
    ) {}

    /**
     * Mapping data dari Model Eloquent ke Data Object
     */
    public static function fromModel(Student $student): self
    {
        return new self(
            id: $student->id,
            name: $student->name,
            nis: $student->nis,
            nisn: $student->nisn,
            nik: $student->nik,

            birth_place: $student->birth_place,
            birth_date: $student->birth_date?->format('Y-m-d'),
            birth_info: "{$student->birth_place}, " . ($student->birth_date ? $student->birth_date->translatedFormat('d F Y') : '-'),
            age: $student->birth_date?->age,

            admission_year: $student->admission_year,
            status: $student->status,
            gender: $student->gender,

            // Relasi lazy-loaded (hanya di-load jika sudah di-eager load)
            user: Lazy::whenLoaded('user', $student, fn () => $student->user ? UserData::from($student->user) : null),
            creator: Lazy::whenLoaded('creator', $student, fn () => $student->creator ? UserData::from($student->creator) : null),

            created_at: $student->created_at?->toIso8601String(),
            updated_at: $student->updated_at?->toIso8601String(),
            created_at_formatted: $student->created_at?->translatedFormat('d M Y H:i'),
        );
    }
}
