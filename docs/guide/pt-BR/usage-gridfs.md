# Using GridFS

This extension supports [MongoGridFS](https://docs.mongodb.com/manual/core/gridfs/) via
classes under namespace `\Yiisoft\Db\MongoDb\File`.
There you will find specific Collection, Query and ActiveRecord classes.

You can upload a file using `\Yiisoft\Db\MongoDb\File\Upload`:

```php
$document = Yii::$app->mongodb->getFileCollection()->createUpload()
    ->addContent('Part 1')
    ->addContent('Part 2')
    // ...
    ->complete();
```

You can download the file using `\Yiisoft\Db\MongoDb\File\Download`:

```php
Yii::$app->mongodb->getFileCollection()->createDownload($document['_id'])->toFile('/path/to/file.dat');
```

Each row of the file query result contains `\Yiisoft\Db\MongoDb\File\Download` instance at the key `file`:

```php
use Yiisoft\Db\MongoDb\File\Query;

$query = new Query();
$rows = $query->from('fs')
    ->limit(10)
    ->all();

foreach ($rows as $row) {
    var_dump($row['file']); // outputs: "object(\Yiisoft\Db\MongoDb\File\Download)"
    echo $row['file']->toString(); // outputs file content
}
```

Using `\Yiisoft\Db\MongoDb\File\ActiveRecord` you can manipulate the file using `file` property:

```php
use Yiisoft\Db\MongoDb\File\ActiveRecord;

class ImageFile extends ActiveRecord
{
    //...
}

$record = new ImageFile();
$record->number = 15;
$record->file = '/path/to/some/file.jpg'; // upload local file to GridFS
$record->save();

$record = ImageFile::find()->where(['number' => 15])->one();
var_dump($record->file); // outputs: "object(\Yiisoft\Db\MongoDb\File\Download)"
echo $row['file']->toString(); // outputs file content
```

You may as well operate GridFS files via regular PHP stream resource.
You will need to register a stream wrapper provided by this extension, `\Yiisoft\Db\MongoDb\File\StreamWrapper`.
This can be done via `\Yiisoft\Db\MongoDb\File\Connection::registerFileStreamWrapper()`.
Once stream wrapper is registered, you may open a stream resource using following format:

```php
'protocol://databaseName.fileCollectionPrefix?file_attribute=value'
```

For example:

```php
Yii::$app->mongodb->registerFileStreamWrapper(); // register stream wrapper

// write a file:
$resource = fopen('gridfs://mydatabase.fs?filename=new_file.txt', 'w');
fwrite($resource, 'some content');
// ...
fclose($resource);

// write file with several fields:
$resource = fopen('gridfs://mydatabase.fs?filename=new_file.txt&number=17&status=active', 'w');
fwrite($resource, 'file number 17 with status "active"');
fclose($resource);

// read a file:
$resource = fopen('gridfs://mydatabase.fs?filename=my_file.txt', 'r');
$fileContent = stream_get_contents($resource);
```
