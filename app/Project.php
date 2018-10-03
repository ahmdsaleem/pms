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

    public function ipnTransactions()
    {
        return $this->hasMany('App\IpnTransaction');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }

    public function platformFieldValues()
    {
        return $this->hasMany('App\PlatformFieldValue');
    }

}
