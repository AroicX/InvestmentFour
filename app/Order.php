<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    
    public function investment ()
    {
        return $this->belongsTo('App\Investment');
    }

    //method creates relationship btw order & transaction
    public function transaction ()
    {
        return $this->hasMany('App\Transaction');
    }
    //end//
}
