<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Models\Stat;

class UpdateStats
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MatchCreated  $event
     * @return void
     */
    public function handle(MatchCreated $event)
    {
        $match = $event->match;

        foreach ($match->teams as $key => $team) {
            $thisTeamStat = Stat::where('team_id', '=', $team->id);

            $thisTeamStat->games++;
            if ($team->homeMatch($match)) {
                $thisTeamStat->goals_for += $match->homeTeamGoals;
                $thisTeamStat->goals_against += $match->awayTeamGoals;
            } else {
                $thisTeamStat->goals_for += $match->awayTeamGoals;
                $thisTeamStat->goals_against += $match->homeTeamGoals;
            }
            $thisTeamStat->goals_difference = $thisTeamStat->goals_for - $thisTeamStat->goals_against;

            if (!$key) {
                if ($team->goalsInMatch($match) > $match->teams[1]->goalsInMatch($match)) {
                    $thisTeamStat->wins += 1;
                    $thisTeamStat->points += 3;
                } elseif ($team->goalsInMatch($match) < $match->teams[1]->goalsInMatch($match)) {
                    $thisTeamStat->loses += 1;
                } else {
                    $thisTeamStat->draws += 1;
                    $thisTeamStat->points += 1;
                }
            } else {
                if ($team->goalsInMatch($match) > $match->teams[0]->goalsInMatch($match)) {
                    $thisTeamStat->wins += 1;
                    $thisTeamStat->points += 3;
                } elseif ($team->goalsInMatch($match) < $match->teams[0]->goalsInMatch($match)) {
                    $thisTeamStat->loses += 1;
                } else {
                    $thisTeamStat->draws += 1;
                    $thisTeamStat->points += 1;
                }
            }
            $thisTeamStat->save();
        }
    }
}
