<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function getGender()
    {
        switch ($this->gender) {
            case 1:
                return 'Male';
                break;
            case 2:
                return 'Female';
                break;
            case 3:
                return 'Other';
                break;
            case 4:
                return 'Not Specified';
                break;
        }
    }
    public function addresses()
    {
        return $this->hasMany('App\CustomerAddress');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function reviews()
    {
        return $this->belongsTo('App\Review');
    }
}
