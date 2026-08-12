<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local'))
            return;

        // create user first
        $userData = [
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'avatar' => null
        ];

        $user = User::create($userData);

        // create admin
        $adminData = [
            'username' => 'admin',
            'user_id' => $user->id
        ];

        Admin::create($adminData);
    }
}
