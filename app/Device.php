<?php

namespace Humiditybot;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function user()
    {
      return $this->belongsTo('Humiditybot\User');
    }

    public function values()
    {
      return $this->hasMany('Humiditybot\Values');
    }
}
