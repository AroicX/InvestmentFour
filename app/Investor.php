<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Investor extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    protected $guarded = ['active', 'twoFA', 'twoFA_verified'];
    protected $primaryKey = 'investor_id'; 

    public $incrementing = false;

    use Authenticatable;

    //relationship declaration//

    public function kin () 
    {
        return $this->hasOne('App\Kin');
    }
}
