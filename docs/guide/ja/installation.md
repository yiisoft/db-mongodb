インストール
============

## 必要条件

このエクステンションは [MongoDB PHP 拡張](http://us1.php.net/manual/en/set.mongodb.php) バージョン 1.0.0 以降を必要とします。

## Composer パッケージを取得する

このエクステンションをインストールするのに推奨される方法は [composer](http://getcomposer.org/download/) によるものです。

下記のコマンドを実行してください。

```
php composer.phar require yiisoft/yii2-mongodb
```

または、あなたの `composer.json` ファイルの `require` セクションに、下記を追加してください。

```
"yiisoft/yii2-mongodb": "~2.1.0"
```

## アプリケーションを構成する

このエクステンションを使用するために必要なことは、下記のコードをあなたのアプリケーション構成情報に追加することだけです。

```php
return [
    //....
    'components' => [
        'mongodb' => [
            'class' => '\Yiisoft\Db\MongoDb\Connection',
            'dsn' => 'mongodb://developer:password@localhost:27017/mydatabase',
        ],
    ],
];
```
