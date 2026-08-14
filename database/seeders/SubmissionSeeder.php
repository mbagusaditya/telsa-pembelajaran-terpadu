<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $student = Student::query()->get(['id'])->first();

        $assignment = Assignment::query()->get(['id'])->first();

        Submission::factory()->setStudent($student)->setAssignment($assignment)->create();
    }
}
