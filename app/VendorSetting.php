<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorSetting extends Model
{
    public function vendors()
    {
        return $this->belongsTo('App\Vendor');
    }
}
