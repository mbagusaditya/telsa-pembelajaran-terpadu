<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    public function create(array $data, ?UploadedFile $avatar = null): Student | false
    {
        $avatarPath = null;

        try {
            // 1. Upload Avatar ke Storage Public (storage:link)
            if ($avatar) {
                $avatarPath = $avatar->store('avatars/students', 'public');
            }

            return DB::transaction(function () use ($data, $avatarPath) {
                // 2. Format Default Password: {nis}_{born_date} (contoh: 011041_2004-01-01)
                $defaultPassword = $data['nis'] . '_' . $data['born_date'];

                // 3. Buat Entri User
                $user = User::create([
                    'email' => $data['email'],
                    'password' => $defaultPassword,
                    'avatar' => $avatarPath,
                ]);

                // Optional: Jika menggunakan Spatie Permission
                $user->assignRole('student');

                // 4. Buat Entri Student (Relasi user_id -> users.id)
                return Student::create([
                    'user_id' => $user->id,
                    'created_by' => auth()->guard('web')->id(),
                    'name' => $data['name'],
                    'nik' => $data['nik'],
                    'gender' => $data['gender'],
                    'nis' => $data['nis'],
                    'nisn' => $data['nisn'],
                    'birth_place' => $data['birth_place'],
                    'birth_date' => $data['birth_date'],
                    'admission_year' => $data['admission_year'],
                    'status' => $data['status'],
                ]);
            });
        } catch (\Throwable $e) {
            if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                Storage::disk('public')->delete($avatarPath);
            }

            return false;
        }
    }
}
