<?php

namespace CesarBalzer\TelegramLogger;

use CesarBalzer\TelegramLogger\Logger\TelegramLogger;
use Illuminate\Support\ServiceProvider;
use Illuminate\Log\LogManager;

class TelegramLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make(LogManager::class)->extend('telegram', function ($app, array $config) {
            return (new TelegramLogger())($config);
        });

        $this->publishes([
            __DIR__ . '/../config/telegram-logger.php' => config_path('telegram-logger.php'),
        ], 'telegram-logger-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            realpath(__DIR__ . '/../config/telegram-logger.php'),
            'telegram-logger'
        );
    }
}
