<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        Teacher::factory(20)
            ->createdBy($admin)
            ->create();
    }
}
