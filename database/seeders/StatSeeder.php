<?php

namespace Database\Seeders;

use App\Models\Stat;
use App\Models\Team;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Team::with('matches.teams')->get() as $team) {
            $wins = $team->wins;
            $draws = $team->draws;
            $defeats = $team->losses;
            $team_id = $team->id;
            $goals = $team->goalsFor;
            $games = $team->games;
            $opponentGoals = $team->goalsAgainst;
            Stat::create(['team_id' => $team_id, 'team_name' => $team->name, 'team_slug' => $team->slug, 'points' => ($wins * 3) + $draws, 'games' => $games, 'wins' => $wins, 'losses' => $defeats, 'draws' => $draws, 'goals_for' => $goals, 'goals_against' => $opponentGoals, 'goals_difference' => ($goals - $opponentGoals)]);
        }
    }
}
