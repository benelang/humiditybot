<?php

namespace humiditybot\Http\Controllers;

use Illuminate\Http\Request;

use humiditybot\Http\Requests;
use humiditybot\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLogin(){
      return View::make('login');
    }
}
