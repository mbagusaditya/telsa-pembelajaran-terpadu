<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
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

        $subjects = [
            [
                'code' => 'PPKN',
                'name' => 'pendidikan pancasila dan kewarganegaraan',
            ],
            [
                'code' => 'BIN',
                'name' => 'bahasa indonesia',
            ],
        ];

        Subject::factory()->createdBy($admin)->createMany($subjects);
    }
}
