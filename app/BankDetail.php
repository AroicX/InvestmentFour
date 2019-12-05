<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model

{
    protected $guarded = ['id'];

     public function bank()
    {
        return $this->belongsTo('App\Bank');
    }


}
