<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local'))
            return;

        $admin = Admin::query()->where('username', 'admin')->get(['user_id'])->first();

        $majors = [
            [
                'code' => 'RPL',
                'name' => 'rekayasa perangkat lunak'
            ],
            [
                'code' => 'TKJ',
                'name' => 'teknik komputer dan jaringan'
            ],
        ];

        Major::factory()->createdBy($admin)->createMany($majors);
    }
}
