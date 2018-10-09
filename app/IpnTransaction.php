<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpnTransaction extends Model
{

    protected $fillable=['customer_id','project_id','type','amount_transfered','payment_method','transaction_id','time','product_id','product_name','form_dump'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }


    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
