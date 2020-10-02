<?php

namespace Database\Seeders;

use App\Models\Match;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = today();
        $teams = DB::table('teams')->get();
        foreach ($teams as $teamA) {
            foreach ($teams as $teamB) {
                if ($teamA->slug !== $teamB->slug) {
                    $date = $date->sub('2 day');
                    Match::create(['played_at' => $date, 'slug' => $teamA->slug . $teamB->slug]);
                }
            }
        }
    }
}
