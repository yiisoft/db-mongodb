<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb;

/**
 * Implement a Data Source Name (DSN) for MongoDb.
 *
 * @see https://www.php.net/manual/en/mongodb-driver-manager.construct.php
 */
final class Dsn
{
    public function __construct(
        public ?string $uri,
        public array $uriOptions = [],
        public array $driverOptions = [],
    ) {}
}
