<?php

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

/**
 * Dog
 *
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class Dog extends Animal
{
    /**
     * {@inheritdoc}
     */
    public static function populateRecord($record, $row)
    {
        parent::populateRecord($record, $row);

        $record->does = 'bark';
    }
}
