<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['name','description','platform_id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }

    public function projectIntegration()
    {
        return $this->hasOne('App\ProjectIntegration');
    }

}
