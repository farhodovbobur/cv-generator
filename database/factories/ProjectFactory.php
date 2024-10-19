<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'name'        => fake()->sentence(2),
            'description' => fake()->text(),
            'source_link' => fake()->url(),
            'demo_link'   => fake()->url(),
        ];
    }
}
