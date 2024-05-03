キャッシュコンポーネントを使用する
==================================

`Cache` コンポーネントを使用するためには、[インストール](installation.md) の節で説明した接続の構成に加えて、`cache` コンポーネントを `Yiisoft\Db\MongoDb\Cache` として構成する必要があります。

```php
return [
    //....
    'components' => [
        // ...
        'cache' => [
            'class' => 'Yiisoft\Db\MongoDb\Cache',
        ],
    ]
];
```
