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
        echo $user;
        if (!$user) {
          $response = "Hi, " . $update->getMessage()->getFrom()->getFirstName() . "!" . PHP_EOL . "Ich würde dir gerne helfen, aber leider kennen wir uns noch gar nicht. Damit wir uns kennen lernen können, besuche bitte humiditybot.com (noch nicht verfügbar).";
        } else {
          $devices = $user->devices;
          if (count($devices) == 0) {
            $response = "Hi, " . $update->getMessage()->getFrom()->getFirstName() . "!" . PHP_EOL . "Ich würde dir gerne helfen, aber du hast leider keine Sensoren registriert. Ich kann dir einen Particle Photon und einen DHT-22 Sensor empfehlen.";
          } else {
            $response = "Aktuelle Messwerte:" . PHP_EOL;
            foreach ($devices as $device) {
              $values = Values::where('device_id', '=', $device->id)->orderBy('id', 'DESC')->take(2)->get();
              if (!$values) {
                $response = "Es tut mir furchtbar leid, aber ich kann in meinem Durcheinander leider keine Werte für dich finden.";
              } else {
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
            }
          }
        }


        $this->replyWithMessage(['text' => $response]);
    }
}
