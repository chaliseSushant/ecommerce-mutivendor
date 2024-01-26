<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorType extends Model
{
    public function vendors()
    {
        return $this->hasMany('App\Vendor');
    }
}
