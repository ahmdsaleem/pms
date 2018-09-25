<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformFieldValue extends Model
{
    public function platformField()
    {
        return $this->belongsTo('App\PlatformField');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
