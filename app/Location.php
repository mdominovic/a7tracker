<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['longitude', 'latitude', 'speed', 'altitude', 'satellites', 'serial_number', 'device_id'];


}
