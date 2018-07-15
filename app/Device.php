<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'serial_number', 'imei', 'user_id', 'contact_1', 'contact_2', 'contact_3', 'center_lat', 'center_lng', 'radius'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
