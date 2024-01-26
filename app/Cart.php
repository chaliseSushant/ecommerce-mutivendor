<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function order()
    {
        return $this->hasOne('App\Order');
    }
    public function discount()
    {
        return 0;
    }
    public function instant_delivery()
    {
        $amount = 0;
        foreach ($this->cartItems->where('is_instant',1) as $instant)
        {
            $amount = $amount + ($instant->product->shipping_instant_base+($instant->product->shipping_instant_additional*($instant->quantity-1)));
        }
        return $amount;
    }
    public function shipping($district = null)
    {
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
    public function countItems()
    {
        return $this->cartItems->count();
    }
    public function decreaseOnOrder()
    {
        foreach ($this->cartItems as $item)
        {
            $product = Product::find($item->product_id);
            $product->stock = $product->stock - $item->quantity;
            $product->save();
        }
    }
    public function subtotal()
    {
        $total = 0;
        foreach ($this->cartItems as $item)
        {
            $total = $total+$item->total();
        }
        return $total;
    }
    public function total()
    {
        return $this->subtotal()+$this->shipping()+$this->instant_delivery()-$this->discount();
    }

    public function deliverable()
    {
        return implode(' / ',District::whereIn('id',explode(',',$this->deliverable_districts))->pluck('name')->toArray());
    }
}
