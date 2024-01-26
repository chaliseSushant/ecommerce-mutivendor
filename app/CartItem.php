<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    public function getBaseShippingAttribute()
    {
        return $this->base_shipping();
    }
    public function getAdditionalShippingAttribute()
    {
        return $this->additional_shipping();
    }
    public function getVendorAttribute()
    {
        return $this->product->vendor_id;
    }
    public function user_district()
    {
        return auth::user()->customer->addresses->where('default',1)->first()->district_id;
    }
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function total()
    {
        return $this->quantity*$this->product->price;
    }
    public function commission()
    {
        return $this->product->categories->where('commission','!=',null)->first()->commission;
    }
    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus');
    }
    public function base_shipping($district = null)
    {
       if ($district == null)
        {
            $district = Auth::user()->customer->addresses->where('default',1)->first()->district_id;
        }
        return $this->product->base_shipping($district);
    }
    public function additional_shipping($district = null)
    {
        if ($district == null)
        {
            $district = Auth::user()->customer->addresses->where('default',1)->first()->district_id;
        }
        return $this->product->additional_shipping($district);
    }
    public function updateQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->save();
    }
}
