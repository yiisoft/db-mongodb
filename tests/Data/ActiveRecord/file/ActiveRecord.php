<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\file;

/**
 * Test Mongo ActiveRecord
 */
class ActiveRecord extends \Yiisoft\Db\MongoDb\File\ActiveRecord
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
