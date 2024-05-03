Installation
============

## Requirements

This extension requires [MongoDB PHP Extension](http://us1.php.net/manual/en/set.mongodb.php) version 1.0.0 or higher.

## Getting Composer package

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-mongodb
```

or add

```
"yiisoft/yii2-mongodb": "~2.2.0"
```

to the require section of your composer.json.

## Configuring application

To use this extension, simply add the following code in your application configuration:

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
