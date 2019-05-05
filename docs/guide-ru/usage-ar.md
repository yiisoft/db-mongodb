Использование MongoDB ActiveRecord
==============================

Расширение предоставляет паттерн ActiveRecord аналогично [[\Yiisoft\Db\ActiveRecord]].
Чтобы объявить класс ActiveRecord вам необходимо расширить [[\Yiisoft\Db\MongoDb\ActiveRecord]] и реализовать методы `collectionName` и `attributes`:

```php
use Yiisoft\Db\MongoDb\ActiveRecord;

class Customer extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'customer';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'name', 'email', 'address', 'status'];
    }
}
```

> Note: первичный ключ названия коллекции (`_id`) должен быть всегда установлен в явном виде в качестве атрибута.

Вы можете использовать [[\yii\data\ActiveDataProvider]] с [[\Yiisoft\Db\MongoDb\Query]] и [[\Yiisoft\Db\MongoDb\ActiveQuery]]:

```php
use yii\data\ActiveDataProvider;
use Yiisoft\Db\MongoDb\Query;

$query = new Query();
$query->from('customer')->where(['status' => 2]);
$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ]
]);
$models = $provider->getModels();
```

```php
use yii\data\ActiveDataProvider;
use app\models\Customer;

$provider = new ActiveDataProvider([
    'query' => Customer::find(),
    'pagination' => [
        'pageSize' => 10,
    ]
]);
$models = $provider->getModels();
```
