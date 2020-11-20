<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests;

use MongoDB\BSON\ObjectID;
use yii\data\ActiveDataProvider;
use Yiisoft\Db\MongoDb\Query;
use Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\ActiveRecord;
use Yiisoft\Db\MongoDb\Tests\Data\ActiveRecord\Customer;

class ActiveDataProviderTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
        ActiveRecord::$db = $this->getConnection();
        $this->setUpTestRows();
    }

    protected function tearDown()
    {
        $this->dropCollection(Customer::collectionName());
        parent::tearDown();
    }

    /**
     * Sets up test rows.
     */
    protected function setUpTestRows()
    {
        $collection = $this->getConnection()->getCollection('customer');
        $rows = [];
        for ($i = 1; $i <= 10; $i++) {
            $rows[] = [
                'name' => 'name' . $i,
                'email' => 'email' . $i,
                'address' => 'address' . $i,
                'status' => $i,
            ];
        }
        $collection->batchInsert($rows);
    }

    // Tests :

    public function testQuery()
    {
        $query = new Query();
        $query->from('customer');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'db' => $this->getConnection(),
        ]);
        $models = $provider->getModels();
        $this->assertCount(10, $models);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'db' => $this->getConnection(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $models = $provider->getModels();
        $this->assertCount(5, $models);
    }

    public function testActiveQuery()
    {
        $provider = new ActiveDataProvider([
            'query' => Customer::find()->orderBy('id ASC'),
        ]);
        $models = $provider->getModels();
        $this->assertCount(10, $models);
        $this->assertTrue($models[0] instanceof Customer);
        $keys = $provider->getKeys();
        $this->assertTrue($keys[0] instanceof ObjectID);

        $provider = new ActiveDataProvider([
            'query' => Customer::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $models = $provider->getModels();
        $this->assertCount(5, $models);
    }
}
