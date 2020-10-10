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
            $wins = 0;
            $draws = 0;
            $defeats = 0;
            $team_id = $team->id;
            $goals = 0;
            $games = 0;
            $opponentGoals = 0;
            foreach ($team->matches as $match) {
                $games++;
                if ($match->teams[0]->id === $team_id) {
                    $thisTeamGoals = $match->teams[0]->pivot->goals;
                    $oppenentTeamGoals = $match->teams[1]->pivot->goals;
                    $goals += $thisTeamGoals;
                    $opponentGoals += $oppenentTeamGoals;
                } else {
                    $thisTeamGoals = $match->teams[1]->pivot->goals;
                    $oppenentTeamGoals = $match->teams[0]->pivot->goals;
                    $goals += $thisTeamGoals;
                    $opponentGoals += $oppenentTeamGoals;
                }
                if ($thisTeamGoals > $oppenentTeamGoals) {
                    $wins++;
                } elseif ($thisTeamGoals === $oppenentTeamGoals) {
                    $draws++;
                } elseif ($thisTeamGoals < $oppenentTeamGoals) {
                    $defeats++;
                }
            }
            Stat::create(['team_id' => $team_id, 'points' => ($wins * 3) + $draws, 'games' => $games, 'wins' => $wins, 'losses' => $defeats, 'draws' => $draws, 'goals_for' => $goals, 'goals_against' => $opponentGoals, 'goals_difference' => ($goals - $opponentGoals)]);
        }
    }
}
