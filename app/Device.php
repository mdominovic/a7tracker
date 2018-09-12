<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'serial_number', 'imei', 'owner_id', 'contact_1', 'contact_2', 'contact_3', 'center_lat', 'center_lng', 'radius', 'home_location'];

//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
