<?php

namespace App\Http\Requests\Student;

use App\Enums\Gender;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('web')->user();

        return $user->can('student.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nik' => ['required', 'unique:students,nik'],
            'gender' => ['required', Rule::in(Gender::cases())],
            'nis' => ['required', 'unique:students,nis'],
            'nisn' => ['required', 'unique:students,nisn'],
            'born_place' => ['required'],
            'born_date' => ['required', 'date'],
            'admission_year' => ['required', 'min:4', 'max:4'],
            'status' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
        ];
    }
}
