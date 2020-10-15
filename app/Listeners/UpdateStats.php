<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Models\Stat;

class UpdateStats
{
    public $match;
    public $event;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MatchCreated $event)
    {
        $this->match = $event->match;
    }

    /**
     * Handle the event.
     *
     * @param  MatchCreated  $event
     * @return void
     */
    public function handle()
    {
        dd($this->match);
        foreach ($this->match->teams as $key => $team) {
            $thisTeamStat = Stat::where('team_id', '=', $team->id)->first();
            $thisTeamStat->games = $team->games;
            $thisTeamStat->goals_for = $team->goalsFor;
            $thisTeamStat->goals_against = $team->goalsAgainst;
            $thisTeamStat->goals_difference = $team->goalsDifference;
            $thisTeamStat->wins = $team->wins;
            $thisTeamStat->losses = $team->losses;
            $thisTeamStat->draws = $team->draws;
            $thisTeamStat->points = $team->points;
        }
        $thisTeamStat->save();
    }
}
