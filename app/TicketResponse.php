<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    protected $guarded = ['id'];

    public function ticket_message ()
    {
        return $this->belongsTo('App\TicketMessage');
    }
}
