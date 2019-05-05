Основы использования
===========

После установки экземпляра соединения с MongoDB, вы можете выполнять MongoDB команды и запросы
используя [[Yiisoft\Db\MongoDb\Command]]:

```php
// выполнить команду:
$result = Yii::$app->mongodb->createCommand(['listIndexes' => 'some_collection'])->execute();

// выполнить запрос (find):
$cursor = Yii::$app->mongodb->createCommand(['projection' => ['name' => true]])->query('some_collection');

// выполнить пакетную операцию:
Yii::$app->mongodb->createCommand()
    ->addInsert(['name' => 'new'])
    ->addUpdate(['name' => 'existing'], ['name' => 'updated'])
    ->addDelete(['name' => 'old'])
    ->executeBatch('customer');
```

Используя экземпляр соединения, вы можете получить доступ к базам данным и коллекциям.
Большинство MongoDB команд доступны через [[\Yiisoft\Db\MongoDb\Collection]] например:

```php
$collection = Yii::$app->mongodb->getCollection('customer');
$collection->insert(['name' => 'John Smith', 'status' => 1]);
```

Для выполнения `find` запросов, вы должны использовать [[\Yiisoft\Db\MongoDb\Query]]:

```php
use Yiisoft\Db\MongoDb\Query;

$query = new Query();
// составление запроса
$query->select(['name', 'status'])
    ->from('customer')
    ->limit(10);
// выполнение запроса
$rows = $query->all();
```
