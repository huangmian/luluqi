<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <?= "<?php " ?>$form = ActiveForm::begin(); 
    	$fieldGroups = [];
        $fields = [];
        <?php foreach ($generator->getColumnNames() as $attribute) {
            if (in_array($attribute, $safeAttributes)) {
                echo "$"."fields[] = ".$generator->generateActiveField($attribute)  .";\n        ";
            }
        } ?>
    	$fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('common', 'BasicInfo'),
            'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
    	echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
    ?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
