<p align="center">
    <a href="https://www.mongodb.com/" target="_blank" rel="external">
        <img src="https://webassets.mongodb.com/_com_assets/cms/mongodb-logo-rgb-j6w271g1xn.jpg" height="80px">
    </a>
    <h1 align="center">Yii Framework MongoDB extension</h1>
    <br>
</p>

This extension provides the [MongoDB](https://www.mongodb.com/) integration for the [Yii framework](https://www.yiiframework.com).

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [README.md](docs/guide/en/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/db-mongodb/v/stable.png)](https://packagist.org/packages/yiisoft/db-mongodb)
[![Total Downloads](https://poser.pugx.org/yiisoft/db-mongodb/downloads.png)](https://packagist.org/packages/yiisoft/db-mongodb)
[![Build Status](https://travis-ci.com/yiisoft/db-mongodb.svg?branch=master)](https://travis-ci.com/yiisoft/db-mongodb)

Installation
------------

This extension requires [MongoDB PHP Extension](https://us1.php.net/manual/en/set.mongodb.php) version 1.0.0 or higher.

This extension requires MongoDB server version 3.0 or higher.

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

```shell
composer require --prefer-dist yiisoft/db-mongodb
```

Configuration
-------------

To use this extension, simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        'mongodb' => [
            'class' => Yiisoft\Db\MongoDb\Connection::class,
            'dsn' => 'mongodb://@localhost:27017/mydatabase',
            'options' => [
                "username" => "Username",
                "password" => "Password"
            ]
        ],
    ],
];
```
