<?php

namespace Database\Seeders;

use App\Models\CourseOffering;
use App\Models\Material;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
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

        Material::factory()
            ->count(3)
            ->createdBy($teacher)
            ->setCourseOffering($courseOffering)
            ->create();
    }
}
