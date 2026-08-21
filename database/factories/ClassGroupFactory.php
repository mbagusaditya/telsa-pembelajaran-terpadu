<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\ClassGroup;
use App\Models\Major;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassGroup>
 */
class ClassGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->bothify('###'),
            'name' => fake()->words(2, true),
            'academic_year' => '2026/2027',
            'major_id' => Major::factory(),
            'homeroom_teacher_id' => Teacher::factory(),
            'created_by' => User::factory(),
        ];
    }

    public function setMajor(Major $major): static
    {
        return $this->state(fn () => [
            'major_id' => $major->id,
        ]);
    }

    public function setHomeroomTeacher(Teacher $teacher): static
    {
        return $this->state(fn () => [
            'homeroom_teacher_id' => $teacher->id,
        ]);
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn () => [
            'created_by' => $admin->user_id,
        ]);
    }
}
