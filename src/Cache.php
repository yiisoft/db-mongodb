<?php

declare(strict_types=1);
/**
 * @link https://www.yiiframework.com/
 *
 * @copyright Copyright © 2008 by Yii Software (https://www.yiiframework.com/)
 * @license https://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb;

use Yii;
use yii\base\InvalidConfigException;
use yii\di\Instance;

/**
 * Cache implements a cache application component by storing cached data in a MongoDB.
 *
 * By default, Cache stores session data in a MongoDB collection named 'cache' inside the default database.
 * This collection is better to be pre-created with fields 'id' and 'expire' indexed.
 * The collection name can be changed by setting [[cacheCollection]].
 *
 * Please refer to [[\yii\caching\Cache]] for common cache operations that are supported by Cache.
 *
 * The following example shows how you can configure the application to use Cache:
 *
 * ```php
 * 'cache' => [
 *     'class' => yii\caching\Cache::class,
 *     'handler' => [
 *         'class' => Yiisoft\Db\MongoDb\Cache::class,
 *         // 'db' => 'mymongodb',
 *         // 'cacheCollection' => 'my_cache',
 *     ]
 * ]
 * ```
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 *
 * @since 2.0
 */
class Cache extends \yii\caching\SimpleCache
{
    /**
     * @var array|Connection|string the MongoDB connection object or the application component ID of the MongoDB connection.
     * After the Cache object is created, if you want to change this property, you should only assign it
     * with a MongoDB connection object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'mongodb';
    /**
     * @var array|string the name of the MongoDB collection that stores the cache data.
     * Please refer to [[Connection::getCollection()]] on how to specify this parameter.
     * This collection is better to be pre-created with fields 'id' and 'expire' indexed.
     */
    public $cacheCollection = 'cache';
    /**
     * @var int the probability (parts per million) that garbage collection (GC) should be performed
     * when storing a piece of data in the cache. Defaults to 100, meaning 0.01% chance.
     * This number should be between 0 and 1000000. A value 0 meaning no GC will be performed at all.
     */
    public $gcProbability = 100;

    /**
     * Initializes the Cache component.
     * This method will initialize the [[db]] property to make sure it refers to a valid MongoDB connection.
     *
     * @throws InvalidConfigException if [[db]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::class);
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        $rowCount = (new Query())
            ->select(['data'])
            ->from($this->cacheCollection)
            ->where([
                'id' => $key,
                '$or' => [
                    [
                        'expire' => 0,
                    ],
                    [
                        'expire' => ['$gt' => time()],
                    ],
                ],
            ])
            ->count($this->db);

        return $rowCount > 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValue($key)
    {
        $row = (new Query())
            ->select(['data'])
            ->from($this->cacheCollection)
            ->where([
                'id' => $key,
                '$or' => [
                    [
                        'expire' => 0,
                    ],
                    [
                        'expire' => ['$gt' => time()],
                    ],
                ],
            ])
            ->one($this->db);

        if (empty($row)) {
            return false;
        }
        return $row['data'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getValues($keys)
    {
        if (empty($keys)) {
            return [];
        }

        $rows = (new Query())
            ->select(['id', 'data'])
            ->from($this->cacheCollection)
            ->where([
                'id' => $keys,
                '$or' => [
                    [
                        'expire' => 0,
                    ],
                    [
                        'expire' => ['$gt' => time()],
                    ],
                ],
            ])
            ->all($this->db);

        $results = array_fill_keys($keys, false);
        foreach ($rows as $row) {
            $results[$row['id']] = $row['data'];
        }

        return $results;
    }

    /**
     * {@inheritdoc}
     */
    protected function setValue($key, $value, $ttl)
    {
        $result = $this->db->getCollection($this->cacheCollection)
            ->update(['id' => $key], [
                'expire' => $ttl > 0 ? $ttl + time() : 0,
                'data' => $value,
            ]);

        if ($result) {
            $this->gc();
            return true;
        }

        return $this->addValue($key, $value, $ttl);
    }

    /**
     * Stores a value identified by a key into cache if the cache does not contain this key.
     * This method should be implemented by child classes to store the data
     * in specific cache storage.
     *
     * @param string $key the key identifying the value to be cached
     * @param string $value the value to be cached
     * @param int $expire the number of seconds in which the cached value will expire. 0 means never expire.
     *
     * @return bool true if the value is successfully stored into cache, false otherwise
     */
    protected function addValue($key, $value, $expire)
    {
        $this->gc();

        if ($expire > 0) {
            $expire += time();
        } else {
            $expire = 0;
        }

        try {
            $this->db->getCollection($this->cacheCollection)
                ->insert([
                    'id' => $key,
                    'expire' => $expire,
                    'data' => $value,
                ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function deleteValue($key)
    {
        $this->db->getCollection($this->cacheCollection)->remove(['id' => $key]);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->db->getCollection($this->cacheCollection)->remove();
        return true;
    }

    /**
     * Removes the expired data values.
     *
     * @param bool $force whether to enforce the garbage collection regardless of [[gcProbability]].
     * Defaults to false, meaning the actual deletion happens with the probability as specified by [[gcProbability]].
     */
    public function gc($force = false)
    {
        if ($force || mt_rand(0, 1000000) < $this->gcProbability) {
            $this->db->getCollection($this->cacheCollection)
                ->remove([
                    'expire' => [
                        '$gt' => 0,
                        '$lt' => time(),
                    ],
                ]);
        }
    }
}
