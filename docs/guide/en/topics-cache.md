# Using the Cache component

To use the [Yii Caching Library](https://github.com/yiisoft/cache), in addition to configuring the connection as described in [General usage](../../../README.md#general-usage) section,
you also have to configure the `cache` component to be `Yiisoft\Db\MongoDb\Cache`:

```php
return [
    //....
    'components' => [
        // ...
        'cache' => [
            'class' => yii\caching\Cache::class,
            'handler' => [
                'class' => Yiisoft\Db\MongoDb\Cache::class,
            ],
        ],
    ]
];
```
