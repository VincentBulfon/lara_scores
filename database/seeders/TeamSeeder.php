<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'Arsenal',
                'slug' => 'ARS',
                'file_path' => 'https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg'
            ],
            [
                'name' => 'Aston Villa',
                'slug' => 'ATV',
                'file_path' => 'https://upload.wikimedia.org/wikipedia/en/f/f9/Aston_Villa_FC_crest_%282016%29.svg'
            ],
            [
                'name' => 'Everton',
                'slug' => 'EVR',
                'file_path' => 'https://upload.wikimedia.org/wikipedia/en/7/7c/Everton_FC_logo.svg'
            ],
            [
                'name' => 'NewCastle United',
                'slug' => 'NCU',
                'file_path' => 'https://en.wikipedia.org/wiki/Newcastle_United_F.C.#/media/File:Newcastle_United_Logo.svg'
            ]
        ];

        foreach ($teams as $team ) {
            Team::create($team);
        }
    }
}
