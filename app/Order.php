<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getCompletedAttribute()
    {
        foreach ($this->cart->cartItems as $item)
        {
            if ($item->orderStatus->delivered != null or $item->orderStatus->rejected != null or $item->orderStatus->cancelled != null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return true;
    }
    public function address()
    {
        return $this->hasOne('App\ShippingAddress');
    }
    public function district()
    {
        return $this->address->district_id;
    }
    public function paymentApis()
    {
        return $this->belongsTo('App\PaymentApi');
    }
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function orderedItems()
    {
        $item_list = collect();
        foreach ($this->cart->cartItems->take(5) as $cart_item)
        {
            $item_list = $item_list->merge($cart_item->product->name);
        }
        return $item_list;

    }
    public function shipping()
    {
        $district = $this->district();
        $shipping_total = 0;
        $setting = Setting::first();
        if ($setting->shipping_type == 1)
        {
            foreach ($this->cartItems as $item)
            {
                $vendors = [];
                if (!in_array($item->vendor, $vendors)) {
                    $vendor = $item->vendor;
                    array_push ( $vendors , $vendor );
                    $base_item = $this->cartItems->where('vendor',$vendor)->where('id',$this->cartItems->sortByDesc('base_shipping')->first()->id)->first();
                    $shipping_total = $base_item->base_shipping($district);
                    if ($base_item->quantity > 1)
                    {
                        $shipping_total = $shipping_total + (($base_item->quantity - 1)*$base_item->additional_shipping($district));
                    }
                    foreach ($this->cartItems->where('vendor',$vendor)->where('id', '!=', $base_item->id) as $add_item)
                    {
                        $shipping_total = $shipping_total + ($add_item->additional_shipping($district) * $add_item->quantity);
                    }
                }

            }
        }
        if ($setting->shipping_type == 2)
        {
            $base_item = $this->cartItems->where('id',$this->cartItems->sortByDesc('base_shipping')->first()->id)->first();
            $shipping_total = $base_item->base_shipping($district);
            if ($base_item->quantity > 1)
            {
                $shipping_total = $shipping_total + (($base_item->quantity - 1)*$base_item->additional_shipping($district));
            }
            foreach ($this->cartItems->where('id', '!=', $base_item->id) as $add_item)
            {
                $shipping_total = $shipping_total + ($add_item->additional_shipping($district) * $add_item->quantity);
            }
        }
        if ($setting->shipping_type == 3)
        {
            $base_item = $this->cartItems->where('id',$this->cartItems->sortByDesc('base_shipping')->first()->id)->first();
            $shipping_total = $base_item->base_shipping($district);
            foreach ($this->cartItems->where('id', '!=', $base_item->id) as $add_item)
            {
                $shipping_total = $shipping_total + $add_item->additional_shipping($district);
            }
        }
        if ($setting->shipping_type == 4)
        {
            $base_item = $this->cartItems->where('id',$this->cartItems->sortByDesc('base_shipping')->first()->id)->first();
            $shipping_total = $base_item->base_shipping($district);
        }
        if ($setting->shipping_type == 5)
        {
            $shipping_total = $setting->default_shipping_charge;
        }
        if ($setting->shipping_type == 6)
        {
            if ($this->subtotal() >= $setting->minimum_order_amount)
            {
                $shipping_total = 0;
            }
            else
            {
                $shipping_total = $setting->default_shipping_charge;
            }

        }
        if ($setting->shipping_type == 7)
        {
            $shipping_total = 0;
        }
        return $shipping_total;

    }
}
