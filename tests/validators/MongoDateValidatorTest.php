<?php

declare(strict_types=1);

namespace Yiisoft\Db\MongoDb\Tests\Validators;

use MongoDB\BSON\UTCDateTime;
use yii\base\Model;
use Yiisoft\Db\MongoDb\Gii\Validators\MongoDateValidator;
use Yiisoft\Db\MongoDb\Tests\TestCase;

class MongoDateValidatorTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
        date_default_timezone_set('UTC');
    }

    public function testValidateValue()
    {
        $validator = new MongoDateValidator();
        $this->assertFalse($validator->validate('string'));
        $this->assertTrue($validator->validate(new UTCDateTime(time() * 1000)));
    }

    public function testValidateAttribute()
    {
        $model = new MongoDateTestModel();

        $model->date = 'string';
        $this->assertFalse($model->validate());
        $model->date = new UTCDateTime(time() * 1000);
        $this->assertTrue($model->validate());
    }

    public function testMongoDateAttribute()
    {
        $model = new MongoDateTestModel();

        $model->date = '05/08/2015';
        $this->assertTrue($model->validate());
        $this->assertTrue($model->mongoDate instanceof UTCDateTime);
        $this->assertEquals('2015-05-08', $model->mongoDate->toDateTime()->format('Y-m-d'));

        $model->date = $model->mongoDate;
        $this->assertTrue($model->validate());
        $this->assertEquals('2015-05-08', $model->mongoDate->toDateTime()->format('Y-m-d'));
    }
}

class MongoDateTestModel extends Model
{
    public $date;
    public $mongoDate;

    public function rules()
    {
        return [
            ['date', MongoDateValidator::class, 'format' => 'MM/dd/yyyy', 'mongoDateAttribute' => 'mongoDate'],
        ];
    }
}
