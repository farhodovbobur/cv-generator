<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LanguageStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'language_id' => Language::factory(),
            'student_id'  => Student::factory(),
            'level_id'    => Level::factory(),
        ];
    }
}
