<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable=['name','email','state','country_code','project_id'];

    public function project()
    {
       return $this->belongsTo('App\Project');
    }

    public function ipnTransactions()
    {
        return $this->hasMany('App\IpnTransaction');
    }


}
