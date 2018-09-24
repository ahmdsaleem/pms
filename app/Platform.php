<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
