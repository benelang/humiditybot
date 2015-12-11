<?php

namespace Humiditybot;

use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
  public function device()
  {
    return $this->belongsTo('Humiditybot\Device');
  }
}
