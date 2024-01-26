<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    public function store()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function minimumHomeDelivery()
    {
        return [
            'status' => $this->setting->enable_min_home_delivery_amount,
            'value' => $this->setting->min_home_delivery_amount,
            'charge' => $this->setting->home_delivery_charge
        ];
    }
    public function minimumFreeHomeDelivery()
    {
        return [
            'status' => $this->setting->enable_min_free_home_delivery_amount,
            'value' => $this->setting->min_free_home_delivery_amount,
            'charge' => $this->setting->home_delivery_charge
        ];
    }
    public function minimumFreeCourier()
    {
        return [
            'status' => $this->setting->enable_min_free_courier_amount,
            'value' => $this->setting->min_free_courier_amount,
            'charge' => $this->setting->courier_charge
        ];
    }
}
