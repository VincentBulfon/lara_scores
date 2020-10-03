<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
