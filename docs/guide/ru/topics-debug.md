Использование MongoDB DebugPanel
============================

Расширение Yii2 MongoDB предоставляет панель отладки, которая может быть интегрирована с модулем отладки yii
и отображать выполняемые запросы MongoDB.

Добавьте следующий код в конфигурацию вашего приложения, чтобы включить его (если у вас уже есть включенный модуль отладки, то достаточно просто добавить конфигурацию панели):

```php
    // ...
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => yii\debug\Module::class,
            'panels' => [
                'mongodb' => [
                    'class' => Yiisoft\Db\MongoDb\Debug\MongoDbPanel::class,
                    // 'db' => 'mongodb', // ID MongoDB компонента, по умолчанию `db`. Раскоментируйте и измените эту строку, если вы регистрируете компонент MongoDB с другим ID.
                ],
            ],
        ],
    ],
    // ...
```