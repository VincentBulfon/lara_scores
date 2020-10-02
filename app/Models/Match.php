<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    /**
     * return the relation between matches and teams
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'Participations')->withPivot('is_home', 'goals');
    }

    /**
     * return the boolean if team is at home or not
     * @return string
     */
    public function getHomeTeamAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 1;
        })->first()->name;
    }

    public function getAwayTeamAttribute()
    {
        return $this->team
    }
}
