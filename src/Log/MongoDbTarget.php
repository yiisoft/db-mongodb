<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb\Log;

use yii\helpers\VarDumper;
use Yiisoft\Log\Target;
use Yiisoft\Db\MongoDb\Connection;

/**
 * MongoDbTarget stores log messages in a MongoDB collection.
 *
 * By default, MongoDbTarget stores the log messages in a MongoDB collection named 'log'.
 * The collection can be changed by setting the [[logCollection]] property.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class MongoDbTarget extends Target
{
    /**
     * @var Connection|string the MongoDB connection object or the application component ID of the MongoDB connection.
     * After the MongoDbTarget object is created, if you want to change this property, you should only assign it
     * with a MongoDB connection object.
     */
    public $db;
    /**
     * @var string|array the name of the MongoDB collection that stores the session data.
     * Please refer to [[Connection::getCollection()]] on how to specify this parameter.
     * This collection is better to be pre-created with fields 'id' and 'expire' indexed.
     */
    public $logCollection;

    public function __construct(Connection $db, $logCollection = 'log')
    {
        $this->db = $db;
        $this->logCollection = $logCollection;
    }

    /**
     * Stores log messages to MongoDB collection.
     */
    public function export(): void
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
