<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Vendor extends Model
{
    use SoftDeletes;

    public function setting()
    {
        return $this->hasOne('App\VendorSetting');
    }

    public function requests()
    {
        return $this->hasMany('App\Request');
    }

    public function documents()
    {
        return $this->hasMany('App\VendorDocument');
    }

    public function type()
    {
        return $this->belongsTo('App\VendorType');
    }

    public function homeLayouts()
    {
        return $this->hasMany('App\HomepageLayoutGroup');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function heros()
    {
        return $this->hasMany('App\HeroSlider');
    }
    public function listProducts()
    {
        $products[$this->id] = Cache::remember('vendor_products_'.$this->id, 22*60, function() {
            return $this->products;
        });
        return $products[$this->id];
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function employees()
    {
        return $this->users->where('role_id', Role::where('role', 'employee')->first()->id);
    }
    public function deactivate()
    {
        $this->status = 0;
        $this->save();
        if ($this->area->activeStoresCount() == 0) {
            $this->area->deactivate();
        }
        return "Store deactivated successfully!";
    }
    public function activate()
    {
        $this->status = 1;
        $this->save();
        if ($this->area->activeStoresCount() == 0 || $this->area->status == 0) {
            $this->area->status = 1;
            $this->area->save();
        }
        return "Store activated successfully!";
    }
    public function isActive()
    {
        return $this->status == 1 ? true : false;
    }
    public function ordersPending()
    {
        return $this->orders()->where('order_status_id', OrderStatus::where('name', 'Pending')->first()->id);
    }
    public function ordersHistory()
    {
        return $this->orders()
            ->where('order_status_id', OrderStatus::where('name', 'Delivered')->first()->id)
            ->orWhere('order_status_id', OrderStatus::where('name', 'Cancelled')->first()->id)
            ->orWhere('order_status_id', OrderStatus::where('name', 'Declined')->first()->id);
    }
    public function ordersProcessing()
    {
        return $this->orders()
            ->where('order_status_id', OrderStatus::where('name', 'Processing Order')->first()->id)
            ->orWhere('order_status_id', OrderStatus::where('name', 'Pending Delivery')->first()->id)
            ->orWhere('order_status_id', OrderStatus::where('name', 'On Delivery')->first()->id);
    }
    public function ordersPaymentProcessing()
    {
        return $this->orders()
            ->where('order_status_id', OrderStatus::where('name', 'Processing Payment')->first()->id)
            ->orWhere('order_status_id', OrderStatus::where('name', 'Partially Paid')->first()->id);
    }
}
