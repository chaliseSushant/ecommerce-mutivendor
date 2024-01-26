<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorDocument extends Model
{
    public function vendor()
    {
        $this->belongsTo('App\Vendor');
    }
}
