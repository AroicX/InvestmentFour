<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyUpload extends Model
{
    public function property_upload_image ()
    {
        return $this->hasOne('App\PropertyUploadImage');
    }

    public function investment ()
    {
        return $this->hasOne('App\Investment');
    }
}
