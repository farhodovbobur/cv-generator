<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
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
            'nt_id'         => fake()->randomFloat(0, 1000, 99999),
            'first_name'    => fake()->firstName(),
            'last_name'     => fake()->lastName(),
            'middle_name'   => fake()->firstName(),
            'gender'        => fake()->randomElement(['male', 'female']),
            'date_of_birth' => fake()->date(),
            'phone'         => fake()->phoneNumber(),
            'email'         => fake()->email(),
            'bio'           => fake()->text(),
            'image'         => fake()->imageUrl(),
        ];
    }
}
