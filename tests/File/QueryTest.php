<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\File;

use Yiisoft\Db\MongoDb\Tests\TestCase;

/**
 * @group file
 */
class QueryTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setUpTestRows();
    }

    protected function tearDown()
    {
        $this->dropFileCollection();
        parent::tearDown();
    }

    /**
     * Sets up test rows.
     */
    protected function setUpTestRows()
    {
        $collection = $this->getConnection()->getFileCollection();
        for ($i = 1; $i <= 10; $i++) {
            $collection->insertFileContent('content' . $i, [
                'filename' => 'name' . $i,
                'file_index' => $i,
            ]);
        }
    }

    // Tests :

    public function testAll()
    {
        $connection = $this->getConnection();
        $query = new Query();
        $rows = $query->from('fs')->all($connection);
        $this->assertCount(10, $rows);
    }

    public function testOne()
    {
        $connection = $this->getConnection();
        $query = new Query();
        $row = $query->from('fs')->one($connection);
        $this->assertIsArray($row);
        $this->assertTrue($row['file'] instanceof Download);
    }

    public function testDirectMatch()
    {
        $connection = $this->getConnection();
        $query = new Query();
        $rows = $query->from('fs')
            ->where(['file_index' => 5])
            ->all($connection);
        $this->assertCount(1, $rows);

        $file = $rows[0];
        $this->assertEquals('name5', $file['filename']);
    }
}
