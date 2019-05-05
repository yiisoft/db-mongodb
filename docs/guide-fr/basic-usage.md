Utilisation Basic
=================

Une fois tu as une connection a MongoDB machine, tu peux executer ces commandes et requettes en utiisant 
[[Yiisoft\Db\MongoDb\Command]]:

```php
// execute command:
$result = Yii::$app->mongodb->createCommand(['listIndexes' => 'some_collection'])->execute();

// execute query (find):
$cursor = Yii::$app->mongodb->createCommand(['projection' => ['name' => true]])->query('some_collection');

// execute batch (bulk) operations:
Yii::$app->mongodb->createCommand()
    ->addInsert(['name' => 'new'])
    ->addUpdate(['name' => 'existing'], ['name' => 'updated'])
    ->addDelete(['name' => 'old'])
    ->executeBatch('customer');
```

En utilisant l'instance de connection, tu peux acceder a les bases de donnee ansi a les collections.
La plupart des commandes de MongoDb sont accessible via [[\Yiisoft\Db\MongoDb\Collection]] instance: 

```php
$collection = Yii::$app->mongodb->getCollection('customer');
$collection->insert(['name' => 'John Smith', 'status' => 1]);
```

Pour effectuer une requette de recherche "find", tu dois utiliser [[\Yiisoft\Db\MongoDb\Query]]: 

```php
use Yiisoft\Db\MongoDb\Query;

$query = new Query();
// compose the query
$query->select(['name', 'status'])
    ->from('customer')
    ->limit(10);
// execute the query
$rows = $query->all();
```

