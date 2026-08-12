<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local'))
            return;

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        Student::factory(100)
            ->createdBy($admin)
            ->create();
    }
}
