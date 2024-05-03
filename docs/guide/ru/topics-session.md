Использование компонентов сессии
===========================

Для использования компонента `Session`, в дополнительных настройках соединения, как описано в разделе [Установка](installation.md),
вы должны настроить компонент `session` как `Yiisoft\Db\MongoDb\Session`:

```php
return [
    //....
    'components' => [
        // ...
        'session' => [
            'class' => Yiisoft\Db\MongoDb\Session::class,
        ],
    ]
];
```
