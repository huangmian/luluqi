<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
?>
<div class="post-tag-form">
    <?php $form = ActiveForm::begin(); 
    	$fieldGroups = [];
        $fields = [];
        $fields[] = $form->field($model, 'tag_name')->textInput(['maxlength' => true]);
    	$fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('common', 'BasicInfo'),
            'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
    	echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>