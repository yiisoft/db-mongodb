MongoDB のアクティブレコードを使用する
======================================

このエクステンションは [[\Yiisoft\Db\ActiveRecord]] と同様なアクティブレコードのソリューションを提供します。
アクティブレコードクラスを宣言するためには、[[\Yiisoft\Db\MongoDb\ActiveRecord]] から拡張して、`collectionName` と 'attributes' のメソッドを実装する必要があります。

```php
use Yiisoft\Db\MongoDb\ActiveRecord;

class Customer extends ActiveRecord
{
    /**
     * @return string このアクティブレコードクラスと関連付けられたインデックスの名前
     */
    public static function collectionName()
    {
        return 'customer';
    }

    /**
     * @return array 属性の名前の配列
     */
    public function attributes()
    {
        return ['_id', 'name', 'email', 'address', 'status'];
    }
}
```

>Note|注意: コレクションのプライマリキーの名前 ('_id') は、常に属性の一つとしてセットアップしなければなりません。

[[\Yiisoft\Db\MongoDb\Query]] および [[\Yiisoft\Db\MongoDb\ActiveQuery]] によって [[\yii\data\ActiveDataProvider]] を使用することが出来ます。

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
