<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformField extends Model
{
    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }

    public function platformFieldValues()
    {
        return $this->hasMany('App\PlatformFieldValue');
    }


}
