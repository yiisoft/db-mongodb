<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

/**
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $name
 * @property float $price
 */
class Item extends ActiveRecord
{
    public static function collectionName()
    {
        return 'item';
    }

    public function attributes()
    {
        return [
            '_id',
            'name',
            'price',
        ];
    }
}
