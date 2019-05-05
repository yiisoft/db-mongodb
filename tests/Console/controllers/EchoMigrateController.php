<?php

namespace Yiisoft\Db\MongoDb\Tests\Console\Controllers;

use Yiisoft\Db\MongoDb\Console\Controllers\MigrateController;

/**
 * MigrateController that writes output via echo instead of using output stream. Allows us to buffer it.
 */
class EchoMigrateController extends MigrateController
{
    /**
     * {@inheritdoc}
     */
    public function stdout($string)
    {
        echo $string;
    }
}
