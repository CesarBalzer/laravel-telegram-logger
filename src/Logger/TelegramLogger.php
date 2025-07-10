<?php

namespace CesarBalzer\TelegramLogger\Logger;

use Monolog\Logger;
use CesarBalzer\TelegramLogger\Logger\TelegramHandler;

class TelegramLogger
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');
        $logger->pushHandler(new TelegramHandler(
            config('telegram-logger.bot_token'),
            config('telegram-logger.chat_id'),
            config('telegram-logger.level'),
        ));

        return $logger;
    }
}
