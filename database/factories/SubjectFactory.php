<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify("SUB-###"),
            'name' => fake()->words(2, true)
        ];
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn() => [
            'created_by' => $admin->user_id
        ]);
    }
}
