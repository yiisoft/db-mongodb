Using the MongoDB ActiveRecord
==============================

This extension provides ActiveRecord solution similar ot the [[\Yiisoft\Db\ActiveRecord]].
To declare an ActiveRecord class you need to extend [[\Yiisoft\Db\MongoDb\ActiveRecord]] and
implement the `collectionName` and 'attributes' methods:

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

Note: collection primary key name ('_id') should be always explicitly setup as an attribute.

You can use [[\yii\data\ActiveDataProvider]] with [[\Yiisoft\Db\MongoDb\Query]] and [[\Yiisoft\Db\MongoDb\ActiveQuery]]:

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
