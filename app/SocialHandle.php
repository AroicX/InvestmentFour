<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialHandle extends Model
{
    //method references relatnshp btw social handels and application
    public function application ()
    {
        return $this->belongsTo('App\Application');
    }
    // end //
}
