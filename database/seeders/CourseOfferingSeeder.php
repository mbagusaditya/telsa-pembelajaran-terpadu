<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ClassGroup;
use App\Models\CourseOffering;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class CourseOfferingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $subject = Subject::query()->get(['id'])->first();

        $teacher = Teacher::query()->get(['id'])->first();

        $classGroup = ClassGroup::query()->get(['id'])->first();

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        CourseOffering::factory()
            ->count(5)
            ->setSubject($subject)
            ->setTeacher($teacher)
            ->setClassGroup($classGroup)
            ->createdBy($admin)
            ->create();
    }
}
