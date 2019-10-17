<?php namespace App; 

use Illuminate\Database\Eloquent\Model; 

class TicketMessage extends Model {
    protected $fillable = [
        'ticket_subject_id',
        'investor_id',
        'message',
        'satisfied',
        'deleted',
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id'];

    public function ticket_subject () { 
        return $this->belongsTo('App\TicketSubject', 'ticket_subject_id'); 
    } 

    public function ticket_response () { 
        return $this->hasMany('App\TicketResponse'); 
    } 
}