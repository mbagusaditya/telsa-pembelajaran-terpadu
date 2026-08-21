<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\CourseOffering;
use App\Models\Material;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(4, true),
            'description' => fake()->words(20, true),
            'visibility' => 'public',
            'created_by' => User::factory(),
            'course_offering_id' => CourseOffering::factory(),
        ];
    }

    public function createdBy(Admin|Teacher $userLike): static
    {
        return $this->state(fn () => [
            'created_by' => $userLike->user_id,
        ]);
    }

    public function setCourseOffering(CourseOffering $courseOffering): static
    {
        return $this->state(fn () => [
            'course_offering_id' => $courseOffering->id,
        ]);
    }
}
