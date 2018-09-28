<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformFieldValue extends Model
{
    protected $fillable=['platform_field_id','project_id','field_value'];

    public function platformField()
    {
        return $this->belongsTo('App\PlatformField');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
