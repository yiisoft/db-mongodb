<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

/**
 * Animal
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property string $type
 *
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class Animal extends ActiveRecord
{
    public $does;

    public static function collectionName()
    {
        return 'test_animals';
    }

    public function attributes()
    {
        return ['_id', 'type'];
    }

    public function init()
    {
        parent::init();
        $this->type = static::class;
    }

    public function getDoes()
    {
        return $this->does;
    }

    /**
     * @param array $row
     *
     * @return Animal
     */
    public static function instantiate($row)
    {
        $class = $row['type'];
        return new $class();
    }
}
