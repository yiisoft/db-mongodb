<?php

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

/**
 * Test Mongo ActiveRecord
 */
class ActiveRecord extends \Yiisoft\Db\MongoDb\ActiveRecord
{
    public static $db;


    /**
     * {@inheritdoc}
     */
    public static function getDb()
    {
        return self::$db;
    }
}
