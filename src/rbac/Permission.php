<?php

declare(strict_types=1);
/**
 * @link https://www.yiiframework.com/
 *
 * @copyright Copyright © 2008 by Yii Software (https://www.yiiframework.com/)
 * @license https://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb\Rbac;

/**
 * Permission is a special version of [[\Yiisoft\Rbac\Permission]] dedicated to MongoDB RBAC implementation.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 *
 * @since 2.0.5
 */
class Permission extends \Yiisoft\Rbac\Permission
{
    /**
     * @var array|null list of parent item names.
     */
    public $parents;
}
