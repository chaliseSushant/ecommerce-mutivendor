<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function customerAddress()
    {
        return $this->hasMany('App\CustomerAddress');
    }
    public function shippingAddress()
    {
        return $this->hasMany('App\ShippingAddress');
    }
    public function outlet()
    {
        return $this->hasMany('App\Outlet');
    }
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
