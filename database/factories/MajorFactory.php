<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Major>
 */
class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->randomElement([
                'RPL',
                'TKJ',
                'MM',
                'TKR'
            ]),
            'name' => fake()->randomElement([
                'rekayasa perangkat lunak',
                'teknik komputer dan jaringan',
                'multimedia',
                'teknik kendaraan ringan'
            ]),
            'created_by' => User::factory()
        ];
    }

    public function createdBy(Admin $admin): static
    {
        return $this->state(fn() => [
            'created_by' => $admin->user_id
        ]);
    }
}
