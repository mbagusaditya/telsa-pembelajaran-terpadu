<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ClassGroup;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local'))
            return;

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        $major = Major::query()->get(['id'])->first();

        $teacher = Teacher::query()->get(['id'])->first();

        ClassGroup::factory()
            ->count(3)
            ->createdBy($admin)
            ->majorId($major)
            ->homeroomTeacherId($teacher)
            ->create();
    }
}
