<?php

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\file;

use Yiisoft\Db\MongoDb\File\ActiveQuery;

/**
 * CustomerFileQuery
 */
class CustomerFileQuery extends ActiveQuery
{
    public function activeOnly()
    {
        $this->andWhere(['status' => 2]);

        return $this;
    }
}
