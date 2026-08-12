<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassGroupSeeder::class);
        $this->call(CourseOfferingSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(StudentClassGroupSeeder::class);
    }
}
