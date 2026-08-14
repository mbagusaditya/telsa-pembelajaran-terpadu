<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CourseOffering;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $courseOffering = CourseOffering::query()->get(['id'])->first();

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        Schedule::factory()
            ->count(3)
            ->setCourseOffering($courseOffering)
            ->createdBy($admin)
            ->create();
    }
}
