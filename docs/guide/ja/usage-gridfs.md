GridFS を使用する
=================

このエクステンションは、名前空間 "\Yiisoft\Db\MongoDb\File" の下にある諸クラスによって [MongoGridFS](https://docs.mongodb.com/manual/core/gridfs/) をサポートしています。
そこに　GridFS のためのコレクション、クエリ、アクティブレコードのクラスがあります。

[[\Yiisoft\Db\MongoDb\File\Upload]] を使ってファイルをアップロードすることが出来ます。

```php
$document = Yii::$app->mongodb->getFileCollection()->createUpload()
    ->addContent('Part 1')
    ->addContent('Part 2')
    // ...
    ->complete();
```

[[\Yiisoft\Db\MongoDb\File\Download]] を使ってファイルをダウンロードすることが出来ます。

```php
Yii::$app->mongodb->getFileCollection()->createDownload($document['_id'])->toFile('/path/to/file.dat');
```

ファイルクエリの結果の各行は、'file' というキーで [[\Yiisoft\Db\MongoDb\File\Download]] のインスタンスを含みます。

```php
use Yiisoft\Db\MongoDb\File\Query;

$query = new Query();
$rows = $query->from('fs')
    ->limit(10)
    ->all();

foreach ($rows as $row) {
    var_dump($row['file']); // 出力: "object(\Yiisoft\Db\MongoDb\File\Download)"
    echo $row['file']->toString(); // ファイルのコンテントを出力
}
```

[\Yiisoft\Db\MongoDb\File\ActiveRecord]] を使うと、'file' プロパティを使ってファイルを操作することが出来ます。

```php
use Yiisoft\Db\MongoDb\File\ActiveRecord;

class ImageFile extends ActiveRecord
{
    //...
}

$record = new ImageFile();
$record->number = 15;
$record->file = '/path/to/some/file.jpg'; // ローカルのファイルを GridFS にアップロード
$record->save();

$record = ImageFile::find()->where(['number' => 15])->one();
var_dump($record->file); // 出力: "object(\Yiisoft\Db\MongoDb\File\Download)"
echo $row['file']->toString(); // ファイルのコンテントを出力
```

GridFS のファイルを通常の PHP ストリームリソースを通じて操作することも出来ます。
そのためには、このエクステンションによって提供されるストリームラッパー [[\Yiisoft\Db\MongoDb\File\StreamWrapper]] を登録する必要があります。
登録は [[\Yiisoft\Db\MongoDb\File\Connection::registerFileStreamWrapper()]] によって行うことが出来ます。
ストリームラッパーを登録すれば、次のフォーマットを使ってストリームリソースをオープンすることが出来ます。

```
'protocol://databaseName.fileCollectionPrefix?file_attribute=value'
```

例えば、

```php
Yii::$app->mongodb->registerFileStreamWrapper(); // ストリームラッパーを登録

// ファイルを書き込む
$resource = fopen('gridfs://mydatabase.fs?filename=new_file.txt', 'w');
fwrite($resource, '何らかのコンテント');
// ...
fclose($resource);

// いくつかのフィールドを持つファイルを書き込む
$resource = fopen('gridfs://mydatabase.fs?filename=new_file.txt&number=17&status=active', 'w');
fwrite($resource, 'ファイル番号 = 17, ステータス = "active"');
fclose($resource);

// ファイルを読み出す
$resource = fopen('gridfs://mydatabase.fs?filename=my_file.txt', 'r');
$fileContent = stream_get_contents($resource);
```
