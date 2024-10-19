<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'russian', 'english', 'spanish', 'french', 'turkish',
        ];

        foreach ($languages as $language) {
            Language::create([
                'language' => $language,
            ]);
        }
    }
}
