<?php

namespace humiditybot;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function ()
    {
      return $this->belongsTo('humiditybot\User');
    }
}
