<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * return the relation between role and user
     * @return void
     */
    public function users()
    {
        $this->belongsTo(App\Models\User::class);
    }
}
