<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
