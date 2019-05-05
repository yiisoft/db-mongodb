<?php

namespace Yiisoft\Db\MongoDb\Tests;

use MongoDB\BSON\ObjectID;
use Yiisoft\ActiveRecord\Data\ActiveDataProvider;
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

        $provider = new ActiveDataProvider($this->getConnection(), $query);
        $models = $provider->getModels();
        $this->assertEquals(10, count($models));

        $provider = new ActiveDataProvider($this->getConnection(), $query);
        $provider->pagination =  [
            'pageSize' => 5,
        ];
        $models = $provider->getModels();
        $this->assertEquals(5, count($models));
    }

    public function testActiveQuery()
    {
        $provider = new ActiveDataProvider($this->getConnection(), Customer::find()->orderBy('id ASC'));
        $models = $provider->getModels();
        $this->assertEquals(10, count($models));
        $this->assertTrue($models[0] instanceof Customer);
        $keys = $provider->getKeys();
        $this->assertTrue($keys[0] instanceof ObjectID);

        $provider = new ActiveDataProvider($this->getConnection(), Customer::find());
        $provider->pagination =  [
            'pageSize' => 5,
        ];
        $models = $provider->getModels();
        $this->assertEquals(5, count($models));
    }
}
