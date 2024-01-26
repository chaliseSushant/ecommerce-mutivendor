<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public function value()
    {
        return $this->hasMany('App\SpecificationValue');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
