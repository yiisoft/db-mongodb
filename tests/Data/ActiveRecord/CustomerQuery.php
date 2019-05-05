<?php

namespace Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord;

use Yiisoft\Db\MongoDb\ActiveQuery;

/**
 * CustomerQuery
 */
class CustomerQuery extends ActiveQuery
{
    public function activeOnly()
    {
        $this->andWhere(['status' => 2]);

        return $this;
    }
}
