<?php

declare(strict_types=1);
/**
 * @link https://www.yiiframework.com/
 *
 * @copyright Copyright © 2008 by Yii Software (https://www.yiiframework.com/)
 * @license https://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb\Log;

use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\VarDumper;
use Yiisoft\Db\MongoDb\Connection;
use Yiisoft\Log\Target;

/**
 * MongoDbTarget stores log messages in a MongoDB collection.
 *
 * By default, MongoDbTarget stores the log messages in a MongoDB collection named 'log'.
 * The collection can be changed by setting the [[logCollection]] property.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 *
 * @since 2.0
 */
class MongoDbTarget extends Target
{
    /**
     * @var Connection|string the MongoDB connection object or the application component ID of the MongoDB connection.
     * After the MongoDbTarget object is created, if you want to change this property, you should only assign it
     * with a MongoDB connection object.
     */
    public $db = 'mongodb';
    /**
     * @var array|string the name of the MongoDB collection that stores the session data.
     * Please refer to [[Connection::getCollection()]] on how to specify this parameter.
     * This collection is better to be pre-created with fields 'id' and 'expire' indexed.
     */
    public $logCollection = 'log';

    /**
     * Initializes the MongoDbTarget component.
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
     * Stores log messages to MongoDB collection.
     */
    public function export()
    {
        $rows = [];
        foreach ($this->messages as $message) {
            [$level, $text, $context] = $message;
            if (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                if ($text instanceof \Throwable || $text instanceof \Exception) {
                    $text = (string) $text;
                } else {
                    $text = VarDumper::export($text);
                }
            }
            $rows[] = [
                'level' => $level,
                'category' => $context['category'],
                'log_time' => $context['time'],
                'prefix' => $this->getMessagePrefix($message),
                'message' => $text,
            ];
        }

        $this->db->getCollection($this->logCollection)->batchInsert($rows);
    }
}
