<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentPayOff extends Model
{
    public function on_rentage ()
    {
        return $this->hasMany('App/OnRentage');
    }
}
