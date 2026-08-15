<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->fakeNik(),
            'nis' => fake()->numerify('######'),
            'nisn' => fake()->unique()->numerify('##########'),
            'name' => fake()->name(),
            'born_date' => fake()->date(),
            'born_place' => fake()->city(),
            'admission_year' => (int) fake()->dateTimeBetween(startDate: '-5 years')->format('Y'),
            'status' => 'active',
            'user_id' => User::factory(),
            'created_by' => User::factory(),
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
        return $this->state(fn() => [
            'user_id' => $user->id
        ]);
    }

    private function fakeNik(): string
    {
        $province = '33';
        $regency = fake()->numerify('##');
        $district = fake()->numerify('##');

        $birthDate = fake()->dateTimeBetween(
            '-40 years',
            '-18 years'
        );

        $date = $birthDate->format('dmy');

        $sequence = fake()->numerify('####');

        return $province
            .$regency
            .$district
            .$date
            .$sequence;
    }
}
