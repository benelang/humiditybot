<?php

namespace Humiditybot\Http\Controllers;

use Illuminate\Http\Request;

use Humiditybot\Http\Requests;
use Humiditybot\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Response;

class TelegramController extends Controller
{
  public function test(){
      $updates = Telegram::getUpdates();

      // Telegram::sendMessage('24560074', 'Ich lebe');
      return Response::json($updates);
  }
}
