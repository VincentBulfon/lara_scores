<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * return the relation between user and role
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * return a boolean that indicate if the user is an admin or not
     * @return bool
     */
    public function getIsAdminAttribute():bool
    {
        return $this->roles->pluck('name')->contains('admin');
    }

    /**
     * return a boolean if the user is and team admin or not
     * @return bool
     */
    public function getIsTeamManagerAttribute():bool
    {
        return $this->roles->pluck('name')->contains('teen-manager');
    }
}
