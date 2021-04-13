Использование интернационализации I18N
=============================

Вы можете использовать [[\Yiisoft\Db\MongoDb\i18n\MongoDbMessageSource]] для хранения переводов i18n сообщений.
Пример конфигурации приложения:

```php
return [
    //....
    'components' => [
        // ...
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => Yiisoft\Db\MongoDb\i18n\MongoDbMessageSource::class
                ]
            ]
        ],
    ]
];
```

Пожалуйста, обратитесь к [[\Yiisoft\Db\MongoDb\i18n\MongoDbMessageSource]] для получения более подробной информации о конфигурации и перевода структуры коллекции данных.
