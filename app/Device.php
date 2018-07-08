<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'serial_number', 'imei', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
