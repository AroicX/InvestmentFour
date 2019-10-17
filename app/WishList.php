<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $guarded = ['id']; //allowing mass assignment//

    public function investment ()
    {
        return $this->belongsTo('App\Investment');
    }
}
