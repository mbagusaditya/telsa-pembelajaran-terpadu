<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Student;
use App\Models\StudentClassGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local'))
            return;

        $student = Student::query()->get(['id'])->first();

        $classGroup = ClassGroup::query()->get(['id'])->first();

        StudentClassGroup::factory()
            ->count(1)
            ->setStudent($student)
            ->setClassGroup($classGroup)
            ->create();
    }
}
