<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
