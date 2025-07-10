<?php

namespace CesarBalzer\TelegramLogger\Logger;

use Monolog\Logger;
use CesarBalzer\TelegramLogger\Logger\TelegramHandler;

class TelegramLogger
{
    public function __invoke(array $config): Logger
    {
        $level = $config['level'] ?? 'error';

        $logger = new Logger('telegram');
        $logger->pushHandler(new TelegramHandler(
            config('telegram-logger.bot_token'),
            config('telegram-logger.chat_id'),
            $level
        ));

        return $logger;
    }
}
