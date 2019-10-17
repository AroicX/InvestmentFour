<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnRentage extends Model
{
    public function investment ()
    {
        return $this->hasOne('App\Investment');
    }

    public function rent_pay_off ()
    {
        return $this->belongsTo('App/RentPayOff');
    }
}
