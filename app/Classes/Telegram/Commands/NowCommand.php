<?php

namespace Humiditybot\Classes\Telegram\Commands;

use Carbon\Carbon;
use Humiditybot\User;
use Humiditybot\Values;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Input;

class NowCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "jetzt";

    /**
     * @var string Command Description
     */
    protected $description = "Die letzten gemessenen Werte";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $update = $this->getUpdate();
        $from = $update->getMessage()->getFrom()->getId();
        $user = User::where('chat_id', '=', $from)->first();
        $devices = $user->devices;

        $response = "Aktuelle Messwerte:" . PHP_EOL;
        foreach ($devices as $device) {
          $values = Values::where('device_id', '=', $device->id)->orderBy('id', 'DESC')->take(2)->get();
          if ($values[0]->humidity > $values[1]->humidty) {
            $trendHumidityCode = "\xE2\xAC\x86"; //going up
          } if ($values[0]->humidity == $values[1]->humidity){
            $trendHumidityCode = "\xE2\x9E\xA1"; //staying the same
          } if ($values[0]->humidity < $values[1]->humidity){
            $trendHumidityCode = "\xE2\xAC\x87"; //going down
          }

          if ($values[0]->temparature > $values[1]->temparature) {
            $trendTemparatureCode = "\xE2\xAC\x86"; //going up
          } if ($values[0]->temparature == $values[1]->temparature){
            $trendTemparatureCode = "\xE2\x9E\xA1"; //staying the same
          } if ($values[0]->temparature < $values[1]->temparature){
            $trendTemparatureCode = "\xE2\xAC\x87"; //going down
          }

          $response .= "Für " . $device->description . " wurden folgende Messwerte gefunden:" . PHP_EOL;
          $response .= "Luftfeuchtigkeit: " . $values[0]->humidity . "% " . $trendHumidityCode . PHP_EOL;
          $response .= "Temparatur: " . $values[0]->temparature . "°C " . $trendTemparatureCode . PHP_EOL;
          date_default_timezone_set('Europe/Berlin');
          $time = strtotime($values[0]->time. ' UTC');
          $response .= "Gemessen am " . date('d.m.Y', $time) . ", um " . date('H:i:s', $time) . PHP_EOL;
        }

        $this->replyWithMessage($response);
    }
}
