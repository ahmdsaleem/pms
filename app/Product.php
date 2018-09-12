<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','description'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

}
