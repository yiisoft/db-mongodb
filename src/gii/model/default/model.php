<?php declare(strict_types=1);
/**
 * This is the template for generating the model class of a specified collection.
 */

/* @var $this yii\web\View */
/* @var $generator Yiisoft\Db\MongoDb\Gii\Model\Generator */
/* @var $collectionName string full collection name */
/* @var $attributes array list of attribute names */
/* @var $className string class name */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */

echo "<?php\n";
?>

namespace <?php echo $generator->ns ?>;

use Yii;

/**
 * This is the model class for collection "<?php echo $collectionName ?>".
 *
<?php foreach ($attributes as $attribute) { ?>
 * @property <?php echo $attribute == '_id' ? '\MongoDB\BSON\ObjectID|string' : 'mixed' ?> <?php echo "\${$attribute}\n" ?>
<?php } ?>
 */
class <?php echo $className ?> extends <?php echo '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
<?php if (empty($generator->databaseName)) { ?>
        return '<?php echo $collectionName ?>';
<?php } else { ?>
        return ['<?php echo $generator->databaseName ?>', '<?php echo $collectionName ?>'];
<?php } ?>
    }
<?php if ($generator->db !== 'mongodb') { ?>

    /**
     * @return \Yiisoft\Db\MongoDb\Connection the MongoDB connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?php echo $generator->db ?>');
    }
<?php } ?>

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
<?php foreach ($attributes as $attribute) { ?>
            <?php echo "'$attribute',\n" ?>
<?php } ?>
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [<?php echo "\n            " . implode(",\n            ", $rules) . "\n        " ?>];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label) { ?>
            <?php echo "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php } ?>
        ];
    }
}
