<?php

declare(strict_types=1);
/**
 * @link https://www.yiiframework.com/
 *
 * @copyright Copyright © 2008 by Yii Software (https://www.yiiframework.com/)
 * @license https://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb;

/**
 * Exception represents an exception that is caused by some Mongo-related operations.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 *
 * @since 2.0
 */
class Exception extends \yii\base\Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'MongoDB Exception';
    }
}
