<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'name'];

    /**
     * return the relation between matches and teams
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function matches()
    {
        return  $this->belongsToMany('App\Models\Match', 'Participations')->withPivot('is_home', 'goals');
    }

    /**
     * return the relation between a team and it stats
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stats()
    {
        return $this->hasOne('App\Models\Stat');
    }

    /**
     * return the corresponding relationship between images and teams
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function images()
    {
        return $this->hasOne('App\Models\Image');
    }

    /**
     * return the number of games played
     * @return int
     */
    public function getGamesAttribute()
    {
        return $this->matches->count();
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
        $goals = [];
        foreach ($this->matches as $match) {
            if ($match->teams[0]->id != $this->id) {
                $goals[] = $match->teams[0]->pivot->goals;
            } else {
                $goals[] = $match->teams[1]->pivot->goals;
            }
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
        $thisTeamTotal = 0;
        $opponentTeamTotal = 0;
        foreach ($this->matches as $match) {
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $awayTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $awayTeamGoals = $match->teams[0]->pivot->goals;
            }
            $thisTeamTotal += $thisTeamGoals;
            $opponentTeamTotal += $awayTeamGoals;
        }

        return $thisTeamTotal - $opponentTeamTotal;
    }

    /**
     * return the numbre of loses
     * @return int
     */
    public function getLosesAttribute()
    {
        $loses = 0;
        foreach ($this->matches as $match) {
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $oppenentTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $oppenentTeamGoals = $match->teams[0]->pivot->goals;
            }
            $thisTeamGoals < $oppenentTeamGoals ? $loses++ : null ;
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
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $oppenentTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $oppenentTeamGoals = $match->teams[0]->pivot->goals;
            }
            $thisTeamGoals === $oppenentTeamGoals ? $draws++ : null ;
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
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $oppenentTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $oppenentTeamGoals = $match->teams[0]->pivot->goals;
            }
            $thisTeamGoals > $oppenentTeamGoals ? $wins++ : null ;
        }

        return $wins;
    }

    /**
     * return the number of points
     * @return int
     */
    public function getPointsAttribute()
    {
        //get winws

        $wins = 0;
        $draws = 0;
        foreach ($this->matches as $match) {
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $oppenentTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $oppenentTeamGoals = $match->teams[0]->pivot->goals;
            }
            if ($thisTeamGoals > $oppenentTeamGoals) {
                $wins++;
            } elseif ($thisTeamGoals === $oppenentTeamGoals) {
                $draws++;
            }
        }

        //calculate points (loses dosen't give any points, wins give 3 points each, draws give 1 point each)
        return ($wins * 3) + $draws;
    }
}
