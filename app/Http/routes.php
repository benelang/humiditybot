<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', array(
  'as' => 'test',
  'uses' => 'Humiditybot\TelegramController@test'
));

*/
Route::get('/', function(){
  return View::make('humiditybot.start');
});


Route::get('login', array(
  'as'=> 'webapp_login',
  'uses' => 'LoginController@showLogin'
));


Route::group(array('prefix' => 'api'), function(){
  Route::post('/values/create', array(
    'as' => 'api_values_create',
    'uses' => 'ParticleController@createValues'
  ));
});
