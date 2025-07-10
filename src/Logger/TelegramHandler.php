<?php

namespace CesarBalzer\TelegramLogger\Logger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Illuminate\Support\Facades\Http;
use Monolog\Level;

class TelegramHandler extends AbstractProcessingHandler
{
    protected string $botToken;
    protected string $chatId;

    public function __construct(string $botToken, string $chatId, string|Level $level = Level::Error, bool $bubble = true)
    {
        $this->botToken = $botToken;
        $this->chatId = $chatId;

        parent::__construct(Level::fromName(strtoupper($level)), $bubble);
    }

    protected function write(LogRecord $record): void
    {
        $message = $record->formatted ?? $record->message;

        Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'chat_id' => $this->chatId,
            'text' => "**[{$record->level->getName()}]**\n```{$message}```",
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true,
        ]);
    }
}
