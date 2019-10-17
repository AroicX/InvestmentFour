<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyUploadImage extends Model
{
    public function property_upload ()
    {
        return $this->belongsTo('App\PropertyUpload');
    }
}
