<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

use Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\file\CustomerFile;

/**
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $status
 * @property string $file_id
 */
class Customer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'email',
            'address',
            'status',
            'file_id',
        ];
    }

    /**
     * @return \Yiisoft\Db\MongoDb\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(CustomerOrder::class, ['customer_id' => '_id']);
    }

    /**
     * @return \Yiisoft\Db\MongoDb\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(CustomerFile::class, ['_id' => 'file_id']);
    }

    /**
     * {@inheritdoc}
     *
     * @return CustomerQuery
     */
    public static function find()
    {
        return new CustomerQuery(static::class);
    }
}
