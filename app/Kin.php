<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    protected $table = 'kins';
    protected $guarded = ['id'];

    //relationship declaration//
    public function investor ()
    {
        return $this->belongsTo('App\Investor');
    }
}
