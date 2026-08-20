<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentChangePasswordRequest;
use App\Models\Student;
use App\Services\ChangePasswordService;
use Inertia\Inertia;

class ChangePasswordController extends Controller
{
    public function student(Student $student, StudentChangePasswordRequest $request, ChangePasswordService $changePasswordService)
    {
        $newData = $request->validated();

        if (! $changePasswordService->changeStudentPassword($student, $newData)) {
            Inertia::flash('toast', [
                'type' => 'error',
                'message' => 'Password gagal diperbarui!',
                'code' => 500,
            ]);

            return back();
        }

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Password berhasil diperbarui!',
            'code' => 200,
        ]);

        return back();
    }

    public function teacher()
    {
        //
    }
}
