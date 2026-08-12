<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\ClassGroup;
use App\Models\CourseOffering;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CourseOffering>
 */
class CourseOfferingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->bothify("####"),
            'name' => fake()->words(2, true),
            'academic_year' => '2026/2027',
        ];
    }

    public function setSubject(Subject $subject): static
    {
        return $this->state(fn() => [
            'subject_id' => $subject->id
        ]);
    }

    public function setClassGroup(ClassGroup $classGroup): static
    {
        return $this->state(fn() => [
            'class_group_id' => $classGroup->id
        ]);
    }

    public function setTeacher(Teacher $teacher): static
    {
        return $this->state(fn() => [
            'teacher_id' => $teacher->id
        ]);
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn() => [
            'created_by' => $admin->user_id
        ]);
    }
}
