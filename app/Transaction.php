<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    //method create a relationship between trnasaction and order
    public function order ()
    {
        return $this->belongsTo('App\Order');
    }
    //end//
}
