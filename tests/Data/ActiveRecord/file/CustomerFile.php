<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\file;

class CustomerFile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'customer_fs';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(
            parent::attributes(),
            [
                'tag',
                'status',
            ]
        );
    }

    /**
     * {@inheritdoc}
     *
     * @return CustomerFileQuery
     */
    public static function find()
    {
        return new CustomerFileQuery(static::class);
    }
}
