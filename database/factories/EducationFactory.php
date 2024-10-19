<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id'  => Student::query()->get()->random()->id,
            'name'        => fake()->name(),
            'description' => fake()->text(),
            'start_date'  => fake()->date(),
            'end_date'    => fake()->date(),
        ];
    }
}
