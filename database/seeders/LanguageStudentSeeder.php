<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(10)
            ->hasAttached(
                Language::all()->random(5),
                ['level_id' => rand(1, 9)]
            )
            ->create();
    }
}
