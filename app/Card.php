<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function container()
    {
        return $this->belongsTo('App\Container');
    }
}
