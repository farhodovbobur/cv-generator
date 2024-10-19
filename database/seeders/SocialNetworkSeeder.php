<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialNetworks = [
            'GitHub' => 'https://github.com/',
            'LinkedIn' => 'https://linkedin.com/',
            'Telegram' => 'https://telegram.com/',
            'Instagram' => 'https://instagram.com/',
            'Youtube' => 'https://youtube.com/',
            'Facebook' => 'https://facebook.com/',
            'GitLab' => 'https://gitlub.com/',
            'Twitter' => 'https://twitter.com/',
            'Google' => 'https://google.com/',
        ];

        foreach ($socialNetworks as $network => $url) {
            SocialNetwork::create([
                'name' => $network,
                'url' => $url,
            ]);
        }
    }
}
