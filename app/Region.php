<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function district()
    {
        return $this->belongsTo('App\District');
    }
    public function customerAddresses()
    {
        return $this->hasMany('App\CustomerAddress');
    }
}
