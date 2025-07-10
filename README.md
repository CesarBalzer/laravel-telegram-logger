![Packagist Version](https://img.shields.io/packagist/v/cesarbalzer/laravel-telegram-logger)
![Release Workflow](https://github.com/CesarBalzer/laravel-telegram-logger/actions/workflows/tag-release.yml/badge.svg)
![License](https://img.shields.io/github/license/CesarBalzer/laravel-telegram-logger)
![PHP Version](https://img.shields.io/packagist/php-v/cesarbalzer/laravel-telegram-logger)
![Downloads](https://img.shields.io/packagist/dt/cesarbalzer/laravel-telegram-logger)
![Last Commit](https://img.shields.io/github/last-commit/CesarBalzer/laravel-telegram-logger)
![Issues](https://img.shields.io/github/issues/CesarBalzer/laravel-telegram-logger)

# Laravel Telegram Logger

Este pacote permite que aplicações Laravel enviem **logs críticos (error, emergency, etc)** diretamente para um **grupo ou canal do Telegram** usando um bot. Ideal para monitorar falhas em produção em tempo real.

---

## ✅ Recursos

-   Envio automático de erros via `Log::error()`, `Log::emergency()`, etc.
-   Suporte a `.env` para configuração rápida.
-   Ignora mensagens irrelevantes como 404 de scans.
-   Integrado com o sistema de logging nativo do Laravel.

---

## 🧰 Instalação

```bash
composer require cesarbalzer/laravel-telegram-logger:@dev
```

Se estiver desenvolvendo localmente com um repositório path:

```json
// composer.json
"repositories": [
  {
    "type": "path",
    "url": "./packages/cesarbalzer/laravel-telegram-logger"
  }
]
```

---

## ⚙️ Configuração

### Adicione no `config/logging.php`:

```php
'channels' => [
    'telegram' => [
        'driver' => 'custom',
        'via' => CesarBalzer\TelegramLogger\Logger\TelegramLogger::class,
        'level' => env('LOG_TELEGRAM_LEVEL'),
    ],
],
```

### Configure seu `.env`:

```env
TELEGRAM_LOGGER_BOT_TOKEN=seu_token_aqui
TELEGRAM_LOGGER_CHAT_ID=-1001234567890
LOG_TELEGRAM_LEVEL=error
```

> ⚠️ O `chat_id` de grupos começa com `-100` seguido dos dígitos do ID.

---

## 🤖 Como criar seu Bot no Telegram

1. No Telegram, abra o `@BotFather`
2. Envie `/newbot` e siga as instruções
3. Copie o `BOT TOKEN` gerado (ex: `123456:ABCDEF...`)

---

## 💬 Como obter o `chat_id` do grupo

1. Crie um grupo no Telegram
2. Adicione o bot ao grupo
3. Envie qualquer mensagem no grupo
4. Acesse no navegador:

```
https://api.telegram.org/bot<SEU_BOT_TOKEN>/getUpdates
```

5. Procure algo assim no JSON retornado:

```json
"chat": {
  "id": -1001234567890,
  "title": "Nome do Grupo",
  ...
}
```

Use o `id` no `.env`.

---

## 🧪 Teste rápido

Você pode testar com uma rota simples ou criar alguns testes forçados:

```php
Route::get('/error', function () {
    // ✅ Log informativo - não vai para o Telegram
    Log::info('HttpRequest GET 200 /home', [
        'method' => 'GET',
        'endpoint' => '/home',
        'status' => 200,
        'ip' => request()->ip(),
    ]);

    // 🚫 Log ignorado por palavra-chave (não será enviado ao Telegram)
    Log::error('HttpRequest GET 404 sitemap.xml', [
        'method' => 'GET',
        'endpoint' => 'sitemap.xml',
        'status' => 404,
        'ip' => request()->ip(),
    ]);

    // ✅ Log de erro real - será enviado ao Telegram
    Log::error('🚨 Erro crítico no processamento do pagamento', [
        'user_id' => 999,
        'order_id' => 12345,
        'status' => 'failed',
    ]);

    // ✅ Simulando exceção capturada
    try {
        throw new \Exception("Erro de teste proposital em /error");
    } catch (\Throwable $e) {
        Log::error("🚨 Exceção capturada em /error: " . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            // Não incluí o trace para não sujar o Telegram
        ]);
    }

    return 'Logs enviados! Verifique o Telegram e o storage/logs/laravel.log';
});


Route::get('/telegram', function () {
    // ✅ Teste direto no canal Telegram
    Log::channel('telegram')->error('🚨 Log de teste no canal Telegram', [
        'user_id' => 999,
        'ip' => request()->ip(),
        'time' => now()->toDateTimeString(),
    ]);

    return 'Log enviado!';
});
```

---

## 📄 Licença

MIT © [Cesar Balzer](https://github.com/cesarbalzer)
