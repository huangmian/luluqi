<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
?>
<div class="post-comment-form">
    <?php $form = ActiveForm::begin(); 
    	$fieldGroups = [];
        $fields = [];
        $fields[] = $form->field($model, 'post_id')->textInput();
        $fields[] = $form->field($model, 'user_id')->textInput();
        $fields[] = $form->field($model, 'parent_id')->textInput();
        $fields[] = $form->field($model, 'desc')->textInput(['maxlength' => true]);
        $fields[] = $form->field($model, 'up')->textInput();
        $fields[] = $form->field($model, 'down')->textInput();
        $fields[] = $form->field($model, 'created_at')->textInput();
        $fields[] = $form->field($model, 'updated_at')->textInput();
    	$fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('common', 'BasicInfo'),
            'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
    	echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>