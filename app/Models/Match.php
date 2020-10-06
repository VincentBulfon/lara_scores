<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    public $fillable = ['played_at', 'slug'];

    /**
     * return the relation between matches and teams
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'Participations')->withPivot('is_home', 'goals');
    }

    /**
     * return the name of the home team
     * @return string
     */
    public function getHomeTeamAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 1;
        })->first()->name;
    }

    /**
     * return the name of the away team
     * @return string
     */
    public function getAwayTeamAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 0;
        })->first()->name;
    }

    /**
     * return number of goals for the home team
     * @return integer
     */
    public function getHomeTeamGoalsAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 1;
        })->first()->pivot->goals;
    }

    /**
     * return the numboer of goals for the away team
     * @return integer
     */
    public function getAwayTeamGoalsAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 0;
        })->first()->pivot->goals;
    }
}
