<?php

namespace Database\Factories;

use App\Models\ClassGroup;
use App\Models\Student;
use App\Models\StudentClassGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudentClassGroup>
 */
class StudentClassGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'joined_at' => now(),
            'left_at' => fake()->randomElement([
                now(),
                null
            ])
        ];
    }

    public function setStudent(Student $student): static
    {
        return $this->state(fn() => [
            'student_id' => $student->id
        ]);
    }

    public function setClassGroup(ClassGroup $classGroup): static
    {
        return $this->state(fn() => [
            'class_group_id' => $classGroup->id
        ]);
    }
}
