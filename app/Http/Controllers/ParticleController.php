<?php

namespace Humiditybot\Http\Controllers;
use Humiditybot\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use Humiditybot\Values;
use Humiditybot\Device;
use Humiditybot\Http\Requests;


class ParticleController extends Controller
{
    /**
     * stores Values that are sent using a partile webhook
     * @return Resonse - A Laravel Response Object
     */
    public function createValues(){
      // $time = time(Input::get('published_at'));
      $time = strtotime(Input::get('published_at'));
      $time =  date('Y-m-d H:i:s', $time);

      $receivedValues = json_decode(Input::get('data'));
      $values = new Values;

      $values->temparature = $receivedValues->temparature;
      $values->humidity = $receivedValues->humidity;

      $device = Device::where('name' , '=', Input::get('coreid'))->first();
      if (!$device) {
        \App::abort(500, 'The device is not registered');
      }
      $values->device_id = $device->id;

      $values->time = $time;

      if (!$values->save()) {
        \App::abort(500, 'An error occured');
      }

      return  Response::json(array('message' =>'Values stored successfully'));

    }
}
