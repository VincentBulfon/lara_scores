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
            ],
            [
                'name' => 'Aston Villa',
                'slug' => 'ATV',
            ],
            [
                'name' => 'Everton',
                'slug' => 'EVR',
            ],
            [
                'name' => 'NewCastle United',
                'slug' => 'NCU',
            ]
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
