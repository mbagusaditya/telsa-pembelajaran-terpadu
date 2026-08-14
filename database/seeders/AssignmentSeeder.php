<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\CourseOffering;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $courseOffering = CourseOffering::query()->get(['id', 'teacher_id'])->first();

        $teacher = Teacher::query()->where('id', $courseOffering->teacher_id)->get(['user_id'])->first();

        Assignment::factory()
            ->count(3)
            ->createdBy($teacher)
            ->setCourseOffering($courseOffering)
            ->create();
    }
}
