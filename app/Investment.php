<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    public function property_upload ()
    {
        return $this->belongsTo('App\PropertyUpload');
    }

    public function order ()
    {
        return $this->hasMany('App\Order');
    }

    public function wishlist ()
    {
        return $this->hasOne('App\WishList');
    }

    public function on_rentage ()
    {
        return $this->belongsTo('App/OnRentage');
    }
}
