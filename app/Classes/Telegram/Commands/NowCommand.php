<?php

namespace Humiditybot\Classes\Telegram\Commands;

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
        echo $user->first_name;
        $devices = $user->devices;
        var_dump($devices);

        $response = "Aktuelle Messwerte:" . PHP_EOL;
        foreach ($devices as $device) {
          $values = Values::where('device_id', '=', $device->id)->orderBy('id', 'DESC')->first();
          $response .= "Für " . $device->description . " wurden folgende Messwerte gefunden:" . PHP_EOL;
          $response .= "Luftfeuchtigkeit: " . $values->humidity . "%" . PHP_EOL;
          $response .= "Temparatur: " . $values->temparature . "°C";
        }

        $this->replyWithMessage($response);
    }
}
