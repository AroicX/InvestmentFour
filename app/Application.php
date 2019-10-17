<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    // method references relatnshp btw application and aboutUs
    public function about_us ()
    {
        return $this->hasOne('App\AboutUs');
    }
    // end //

    // method references relatnshp btw application and social handles
    public function social_handle ()
    {
        return $this->hasMany('App\SocialHandle');
    }
    // end //

    // method references relationshp btw application and contact Us
    public function contact_us ()
    {
        return $this->hasMany('App\ContactUs');
    }
    // end //

    // method references relatnshp btw application and team
    public function team ()
    {
        return $this->hasMany('App\Team');
    }
    // end //

    // method references relatnshp btw application and team role
    public function team_role ()
    {
        return $this->hasMany('App\TeamRole');
    }
    // end //
}
