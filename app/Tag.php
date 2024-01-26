<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
