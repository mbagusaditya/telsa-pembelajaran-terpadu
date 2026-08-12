<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\CourseOffering;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $times = [
            '07:40:00',
            '08:20:00',
            '09:00:00',
            '09:55:00',
            '10:35:00',
            '11:15:00',
            '11:55:00',
        ];

        $index = fake()->numberBetween(0, 5);

        return [
            'place' => fake()->randomElement([
                'Ruang 01',
                'Ruang 02',
                'Ruang 03',
                'Lapangan'
            ]),
            'started_at' => $times[$index],
            'finished_at' => $times[$index + 1],
            'day' => fake()->randomElement([
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday'
            ])
        ];
    }

    public function setCourseOffering(CourseOffering $courseOffering): static
    {
        return $this->state(fn() => [
            'course_offering_id' => $courseOffering->id
        ]);
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn() => [
            'created_by' => $admin->user_id
        ]);
    }
}
