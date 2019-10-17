<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // method references relatnshp btw team and application
    public function application ()
    {
        return $this->belongsTo('App\Application');
    }
    // end //

    // method references relatnshp btw team and team roles
    public function team_role ()
    {
        return $this->belongsTo('App\TeamRole');
    }
    // end //
}
