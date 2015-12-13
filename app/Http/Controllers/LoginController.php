<?php

namespace Humiditybot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Humiditybot\Http\Requests;
use Humiditybot\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLogin(){
      return View::make('humiditybot.login');
    }
}
