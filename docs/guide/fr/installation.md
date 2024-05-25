Installation
============

## Requirements

l'extention  [MongoDB PHP Extension](https://www.php.net/manual/fr/set.mongodb.php) version 1.0.0 ou plus.

## Installation du composer:

Il est preferable d'installer composer depuis :  [composer](https://getcomposer.org/download/).

et puis executer la commande: 

```
composer require yiisoft/yii2-mongodb
```

ou bien ajouter : 

```
"yiisoft/yii2-mongodb": "~2.1.0"
```

a la section `require` de votre `composer.json`.

## Configuration de votre application

Pour l'utilisation de cette extention, il suffit d'ajouter le code suivant a configuration de votre application:

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
