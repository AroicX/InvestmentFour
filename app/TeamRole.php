<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamRole extends Model
{
    // method references relatnshp btw team roles and application
    public function application ()
    {
        return $this->belongsTo('App\Application');
    }
    // end //

    // method references relatnshp btw team roles and teams
    public function team ()
    {
        return $this->hasMany('App\Team');
    }
    // end //
}
