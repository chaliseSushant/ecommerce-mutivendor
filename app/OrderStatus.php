<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;
    public function cartItem()
    {
        return $this->hasMany('App\CartItem');
    }
}
