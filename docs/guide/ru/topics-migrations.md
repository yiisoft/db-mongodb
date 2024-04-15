Использование миграции
================

MongoDB это - schemaless-бд и может создать необходимые коллекции по первому требованию. Однако, есть много случаев когда вам может понадобиться применение постоянных изменений в базу данных MongoDB. Для примера: вам может понадобится создать коллекцию с некоторыми конкретными вариантами или индексы.
MongoDB миграции управляются с помощью [[Yiisoft\Db\MongoDb\Console\Controllers\MigrateController]], который являетя аналогом регулярного
[[\Yiisoft\Yii\Console\Controllers\MigrateController]].

Для того, чтобы включить эту команду, вы должны настроить конфигурацию консольного приложения:

```php
return [
    // ...
    'controllerMap' => [
        'mongodb-migrate' => 'Yiisoft\Db\MongoDb\Console\Controllers\MigrateController'
    ],
];
```

Ниже приведены примеры использования этой команды:

```
# создать миграцию с именем 'create_user_collection'
yii mongodb-migrate/create create_user_collection

# применить ВСЕ новые миграции
yii mongodb-migrate

# отменить последние примененные миграции
yii mongodb-migrate/down
```
