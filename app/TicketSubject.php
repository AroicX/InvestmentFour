<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketSubject extends Model
{
    protected $guarded = ['id'];

    public function ticket_message () //model relationship for ticketmessage
    {
        return $this->hasMany('App\TicketMessage');
    }
}
