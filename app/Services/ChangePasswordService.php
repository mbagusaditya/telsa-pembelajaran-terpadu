<?php

namespace App\Services;

use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class ChangePasswordService
{
    public function changeStudentPassword(Student $student, array $data): bool
    {
        try {
            DB::transaction(function () use ($data, $student) {
                $isSameStudent = $student->name === $data['student_name'];

                if (! $isSameStudent) {
                    throw new Exception('Nama tidak cocok');
                }

                $student->user->update([
                    'password' => $data['password'],
                ]);
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
