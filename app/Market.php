<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public function Investment ()
    {
        return $this->belongsTo('App\Investment');
    }

    public function Investor ()
    {
        return $this->belongsTo('App\Investor');
    }

    //method creates relationship btw order & transaction
    public function Order ()
    {
        return $this->belongsTo('App\Order');
    }

    public function Transaction ()
    {
        return $this->belongsTo('App\Transaction');
    }
}
