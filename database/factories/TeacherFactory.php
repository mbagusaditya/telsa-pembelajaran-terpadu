<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('########'),
            'name' => fake()->name(),
            'wa_number' => fake()->numerify('08##########'),
            'gender' => fake()->randomElement(Gender::cases()),
            'user_id' => User::factory()->teacher(),
            'created_by' => User::factory()->admin(),
            'joined_at' => fake()->dateTimeBetween(startDate: '-20 years')->format('Y-m-d'),
        ];
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn (array $attributes) => [
            'created_by' => $admin->user_id,
        ]);
    }

    public function setUser(User $user): static
    {
        return $this->state(fn () => [
            'user_id' => $user->id,
        ]);
    }
}
