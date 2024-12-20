<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            SocialNetworkSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            LanguageSeeder::class,
            LevelSeeder::class,
            SocialNetworkStudentSeeder::class,
            SkillStudentSeeder::class,
            LanguageStudentSeeder::class,
        ]);
    }
}
