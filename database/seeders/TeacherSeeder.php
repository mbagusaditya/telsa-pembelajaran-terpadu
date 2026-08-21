<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
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

        // for auth testing purposes
        $user = User::factory()->create([
            'email' => 'teacher@gmail.com',
            'password' => 'teacher123',
        ]);

        $user->assignRole(UserRole::Teacher->value);

        Teacher::factory()
            ->setUser($user)
            ->create();

        // dummy data
        Teacher::factory(20)
            ->createdBy($admin)
            ->create();
    }
}
