<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    // method references relatnshp btw contact Us and application
    public function application ()
    {
        return $this->belongsTo('App\Application');
    }
    // end //
}
