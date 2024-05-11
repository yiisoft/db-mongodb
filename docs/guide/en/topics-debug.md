# Using the MongoDB DebugPanel

The Yii MongoDB Extension provides a debug panel that can be integrated with the [Yii Debug Extension](https://github.com/yiisoft/yii-debug)
and shows the executed MongoDB queries.

Add the following to you application config to enable it (if you already have the [Yii Debug Extension](https://github.com/yiisoft/yii-debug)
enabled, it is sufficient to just add the panels configuration):

```php
    // ...
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => yii\debug\Module::class,
            'panels' => [
                'mongodb' => [
                    'class' => Yiisoft\Db\MongoDb\Debug\MongoDbPanel::class,
                    // 'db' => 'mongodb', // MongoDB component ID, defaults to `db`. Uncomment and change this line, if you registered MongoDB component with a different ID.
                ],
            ],
        ],
    ],
    // ...
```
