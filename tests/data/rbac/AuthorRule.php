<?php

namespace Yiisoft\Db\MongoDb\Tests\Data\Rbac;

use Yiisoft\Rbac\Item;
use Yiisoft\Rbac\Rule;

/**
 * Checks if authorID matches userID passed via params
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';
    public $reallyReally = false;


    public function execute(string $userId, Item $item, array $parameters = []): bool
    {
        return $parameters['authorID'] == $parameters;
    }
}
