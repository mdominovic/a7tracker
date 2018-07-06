<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['longitude', 'latitude', 'speed', 'altitude', 'timestamp', 'satellites', 'serial_number'];

}
