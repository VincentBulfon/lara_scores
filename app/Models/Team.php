<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;

    /**
     * return the relation between matches and teams
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function matches()
    {
        return  $this->belongsToMany('App\Models\Match', 'Participations')->withPivot('is_home', 'goals');
    }

    /**
     * return the relation between matches and teams
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participations()
    {
        return $this->hasMany('App\Models\Participation');
    }

    /**
     * return the number of games played
     * @return int
     */
    public function getTotalGamesAttribute()
    {
        return $this->matches()->count();
    }

    /**
     * return the number of gaols scored by the team
     * @return int
     */
    public function getGoalsForAttribute()
    {
        foreach ($this->matches as $match) {
            $goals[] = $match->pivot->goals;
        }

        return array_sum($goals);
    }

    /**
     * return the number of goals scored against this team
     * @return int
     */
    public function getGoalsAgainstAttribute()
    {
        foreach ($this->matches as $match) {
            $goals[] = DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '!=', $this->id]])->first()->goals;
        }

        return array_sum($goals);
    }

    /**
     *
     * return the goals
     * @return int
     * @throws \InvalidArgumentException
     */
    public function getGoalsDifferenceAttribute()
    {
        foreach ($this->participations as $participation) {
            $teamGoals[] = $participation->goals;
        }

        foreach ($this->matches as $match) {
            //old teamGoals request the create a new request outside the eloquent model for each team
            //$teamGoals[] = DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '=', $this->id]])->first()->goals;

            $oppoenentGoals[] = DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '!=', $this->id]])->first()->goals;
        }

        return array_sum($teamGoals) - array_sum($oppoenentGoals);
    }

    /**
     * return the numbre of loses
     * @return int
     */
    public function getLosesAttribute()
    {
        $loses = 0;
        foreach ($this->matches as $match) {
            if (DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '=', $this->id]])->first()->goals < DB::table('participations')->where([['match_id', '!=', $match->id], ['team_id', '=', $this->id]])->first()->goals) {
                $loses += 1;
            }
        }

        return $loses;
    }

    /**
     * return the numbre of draws
     * @return int
     */
    public function getDrawsAttribute()
    {
        $draws = 0;
        foreach ($this->matches as $match) {
            if (DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '=', $this->id]])->first()->goals == DB::table('participations')->where([['match_id', '!=', $match->id], ['team_id', '=', $this->id]])->first()->goals) {
                $draws += 1;
            }
        }

        return $draws;
    }

    /**
     * return the number of wins
     * @return int
     */
    public function getWinsAttribute()
    {
        $wins = 0;
        foreach ($this->matches as $match) {
            if (DB::table('participations')->where([['match_id', '=', $match->id], ['team_id', '=', $this->id]])->first()->goals > DB::table('participations')->where([['match_id', '!=', $match->id], ['team_id', '=', $this->id]])->first()->goals) {
                $wins += 1;
            }
        }

        return $wins;
    }

    /**
     * return the number of points
     * @return int
     */
    public function getPointsAttribute()
    {
        // code...
    }

    /**
     * return the number of goals scored while this team was at home
     * @return int
     */
    // public function getGoalsForAtHomeAttribute()
    // {
    //     foreach (
    //         $this->matches->filter(function ($match) {
    //             return $match->pivot->is_home === 0;
    //         })->all()
    //     as $matchWhenIsHome) {
    //         $WhenIsHomeGoals[] = $matchWhenIsHome->pivot->goals;
    //     }

    //     return array_sum($HomeTeamGoals);
    // }
}
