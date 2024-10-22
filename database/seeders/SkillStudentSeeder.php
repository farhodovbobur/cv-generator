<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(10)
            ->hasAttached(Skill::all()->random(10))
            ->create();
    }
}
