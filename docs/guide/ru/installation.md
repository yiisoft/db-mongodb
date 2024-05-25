Установка
============

## Требования

Это расширение требует [MongoDB PHP Extension](https://www.php.net/manual/ru/set.mongodb.php) версии 1.0.0 или выше.

## Получение с помощью Composer

Предпочтительный способ установки расширения через  [composer](https://getcomposer.org/download/).

Для этого запустите

```
composer require yiisoft/yii2-mongodb
```

или добавьте

```
"yiisoft/yii2-mongodb": "~2.1.0"
```

в секцию require вашего composer.json.

## Настройка приложения

Для использования расширения, просто добавьте этот код в конфигурацию вашего приложения:

```php
return [
    //....
    'components' => [
        'mongodb' => [
            'class' => Yiisoft\Db\MongoDb\Connection::class,
            'dsn' => 'mongodb://developer:password@localhost:27017/mydatabase',
        ],
    ],
];
```
