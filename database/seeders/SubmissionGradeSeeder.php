<?php

namespace Database\Seeders;

use App\Models\Submission;
use App\Models\SubmissionGrade;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SubmissionGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $teacher = Teacher::query()->get(['id'])->first();

        $submission = Submission::query()->get(['id'])->first();

        SubmissionGrade::factory()->setTeacher($teacher)->setSubmission($submission)->create();
    }
}
