<?php

namespace Database\Factories;

use App\Models\Submission;
use App\Models\SubmissionGrade;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubmissionGrade>
 */
class SubmissionGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'score' => fake()->numberBetween(40, 100),
            'feedback' => fake()->randomElement([
                fake()->words(10,true),
                null
            ]),
            'teacher_id' => Teacher::factory(),
            'submission_id' => Submission::factory(),
        ];
    }

    public function setTeacher(Teacher $teacher): static
    {
        return $this->state(fn() => [
            'teacher_id' => $teacher->id
        ]);
    }

    public function setSubmission(Submission $submission): static
    {
        return $this->state(fn() => [
            'submission_id' => $submission->id
        ]);
    }
}
