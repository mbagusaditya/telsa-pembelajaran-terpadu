<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
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
            'email' => 'user01@gmail.com',
            'password' => 'user123'
        ]);

        $user->assignRole(UserRole::Student->value);

        Student::factory()
        ->setUser($user)
        ->create([
            'nis' => '123456'
        ]);

        // dummy data
        Student::factory(100)
            ->createdBy($admin)
            ->create();
    }
}
