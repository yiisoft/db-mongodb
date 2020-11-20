<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator Yiisoft\Db\MongoDb\Gii\Model\Generator */

echo $form->field($generator, 'collectionName');
echo $form->field($generator, 'databaseName');
echo $form->field($generator, 'attributeList');
echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'ns');
echo $form->field($generator, 'baseClass');
echo $form->field($generator, 'db');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
