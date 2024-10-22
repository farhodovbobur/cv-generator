<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SocialNetworkStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(10)
            ->hasAttached(
                SocialNetwork::factory(10)->create(),
                ['username' => 'student']
            )
            ->create();
    }
}
