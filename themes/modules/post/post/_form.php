<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use modules\post\models\Post;
?>
<div class="post-form">
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    $fieldGroups = [];
    $fields = [];
    $fields[] = $form->field($model, 'title')->textInput();
    $fields[] = $form->field($model, 'user_id')->textInput();
    $fields[] = $form->field($model, 'type_id')->dropDownList(Post::getFilterType());
    $fields[] = $form->field($model, 'is_visible')->dropDownList(Yii::$app->params['luluyiiGlobal']['is_visible']);
    $fields[] = $form->field($model, 'is_top')->dropDownList(Yii::$app->params['luluyiiGlobal']['is_top']);
    $fields[] = $form->field($model, 'is_essence')->dropDownList(Yii::$app->params['luluyiiGlobal']['is_essence']);
    $fields[] = $form->field($model, 'is_reprint')->dropDownList(Yii::$app->params['luluyiiGlobal']['is_reprint']);
    if (Yii::$app->controller->action->id == 'update'){
        $fields[] = $form->field($model, 'up')->textInput();
        $fields[] = $form->field($model, 'down')->textInput();
        $fields[] = $form->field($model, 'comment_num')->textInput();
        $fields[] = $form->field($model, 'view_num')->textInput();
        $fields[] = $form->field($model, 'collection')->textInput();
    }
    $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('common', 'BasicInfo'), 
                    'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
    
    $fields = [];
    $fields[] = $form->field($model, 'content')->widget(lulubin\redactor\widgets\Redactor::className(),['clientOptions'=>['lang'=>'zh_cn']]);
    $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i>' . Yii::t('post', 'Content'),
        'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
    
    echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
 ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>