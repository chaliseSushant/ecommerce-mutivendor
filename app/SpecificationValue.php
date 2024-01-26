<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationValue extends Model
{
    public function specification()
    {
        return $this->belongsTo('App\Specification');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
