<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::query()->get()->random()->id,
            'company' => fake()->company(),
            'position' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}
