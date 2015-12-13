<?php

namespace Humiditybot\Classes\Telegram\Commands;

use Telegram\Bot\Commands\Command;

/**
 * Class HelpCommand
 *
 * @package Telegram\Bot\Commands
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "hilfe";

    /**
     * @var string Command Description
     */
    protected $description = "Liste mit verfügbaren Befehlen";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $commands = $this->telegram->getCommands();

        $response = '';
        foreach ($commands as $name => $handler) {
            $response .= sprintf('/%s - %s'.PHP_EOL, $name, $handler->getDescription());
        }

        $this->replyWithMessage($response);
    }
}
