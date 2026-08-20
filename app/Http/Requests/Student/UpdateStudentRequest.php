<?php

namespace App\Http\Requests\Student;

use App\Enums\Gender;
use App\Enums\StudentStatus;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::guard('web')->user();

        return $user->can('student.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Student|string $student */
        $student = $this->route('student');

        $studentId = $student instanceof Student ? $student->id : $student;
        $userId = $student instanceof Student ? $student->user_id : Student::where('id', $studentId)->value('user_id');

        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'nik' => ['required', Rule::unique('students', 'nik')->ignore($studentId)],
            'gender' => ['required', Rule::in(Gender::cases())],
            'nis' => ['required', Rule::unique('students', 'nis')->ignore($studentId)],
            'nisn' => ['required', Rule::unique('students', 'nisn')->ignore($studentId)],
            'birth_place' => ['required'],
            'birth_date' => ['required', 'date'],
            'admission_year' => ['required', 'min:4', 'max:4'],
            'status' => ['required', Rule::in(StudentStatus::cases())],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }
}
