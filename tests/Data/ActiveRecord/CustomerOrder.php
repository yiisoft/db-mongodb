<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

/**
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property int $number
 * @property \MongoDB\BSON\ObjectID $customer_id
 * @property array $item_ids
 */
class CustomerOrder extends ActiveRecord
{
    public static function collectionName()
    {
        return 'customer_order';
    }

    public function attributes()
    {
        return [
            '_id',
            'number',
            'customer_id',
            'item_ids',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['_id' => 'customer_id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::class, ['_id' => 'item_ids']);
    }
}
