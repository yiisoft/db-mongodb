<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Data\Rbac;

use Yiisoft\Rbac\Rule;

class ActionRule extends Rule
{
    public $name = 'action_rule';
    public $action = 'read';

    /**
     * {@inheritdoc}
     */
    public function execute($user, $item, $params)
    {
        return $this->action === 'all' || $this->action === $params['action'];
    }
}
