<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\MongoDb\Rbac;

/**
 * Permission is a special version of [[\Yiisoft\Rbac\Permission]] dedicated to MongoDB RBAC implementation.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.5
 */
class Permission extends \Yiisoft\Rbac\Permission
{
    /**
     * @var array|null list of parent item names.
     */
    public $parents;
}
