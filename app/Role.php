<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function privileges()
    {
        return $this->belongsToMany('App\Privilege');
    }

    public function hasPrivilege($privilege)
    {
        $return = $this->privileges->where('privilege',$privilege)->first();
        return $return != null ? true : false ;
    }

}
