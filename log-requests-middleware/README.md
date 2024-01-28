# LogRequestsMiddleware

LogRequestsMiddleware - это middleware для логирования входящих HTTP-запросов в Laravel-приложении.

## Установка

### Установите пакет с помощью Composer:

```bash
    composer require ioj4z/log-requests-middleware
```
#### После успешной установки пакета необходимо зарегистрировать middleware в вашем Laravel-приложении.

### Использование

#### Регистрация middleware:
    Откройте файл app/Http/Kernel.php.
    Добавьте ваш middleware в свойство $middleware, чтобы он был включен в глобальный стек middleware:

  ``` php
        protected $middleware = [
        // Другие middleware...
        \ioj4z\LogRequestsMiddleware\LogRequestsMiddleware::class,
    ];
  ```
#### Создание канала для логирования HTTP-запросов

Для того чтобы сохранять HTTP-запросы в отдельный лог-файл, необходимо создать специальный канал в вашем файле конфигурации логирования.

Откройте файл `config/logging.php` в вашем Laravel-приложении, и добавьте следующий код в раздел `'channels'`:

```php
'request' => [
    'driver' => 'daily',
    'path' => storage_path('logs/request.log'),
    'level' => env('LOG_LEVEL', 'debug'),
    'days' => 14,
],
```

### Использование middleware в маршрутах:

Вы можете назначить ваш middleware к определенным маршрутам или группам маршрутов в файле routes/web.php или routes/api.php.

#### Пример назначения middleware к группе маршрутов:

 ``` php
        Route::middleware([\ioj4z\LogRequestsMiddleware\LogRequestsMiddleware::class])->group(function () {
            // Здесь определите маршруты, для которых нужно использовать middleware
        });
 ```
 
## Лицензия

MIT
