<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    public function childs() {
        return $this->hasMany('App\Menu','parent_id','id') ;
    }
    public function child() {
        return $this->hasMany('App\Menu','parent_id','id') ;
    }
    public function hasChild()
    {
        return $this->childs->count();
    }
    public function parent()
    {
        return $this->belongsTo('App\Menu','parent_id')->with('parent');
    }
}
