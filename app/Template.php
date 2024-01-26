<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function containers()
    {
        return $this->hasMany('App\Container');
    }
}
