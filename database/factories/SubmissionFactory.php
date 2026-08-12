<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notes' => fake()->words(10, true),
            'attempt_number' => 1,
            'student_id' => Student::factory(),
            'assignment_id' => Assignment::factory(),
            'submitted_at' => fake()->randomElement([
                now(),
                now()->addDays(10)
            ])
        ];
    }

    public function setStudent(Student $student): static
    {
        return $this->state(fn() => [
            'student_id' => $student->id
        ]);
    }

    public function setAssignment(Assignment $assignment): static
    {
        return $this->state(fn() => [
            'assignment_id' => $assignment->id
        ]);
    }
}
