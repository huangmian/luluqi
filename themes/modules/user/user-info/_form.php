<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
?>
<div class="user-info-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        $fieldGroups = [];
        $fields = [];
        $fields[] = $form->field($model, 'sex')->dropDownList(Yii::$app->params['luluyiiGlobal']['sex']);
        $fields[] = $form->field($model, 'qq')->textInput();
        $fields[] = $form->field($model, 'birthday')->textInput();
        $fields[] = $form->field($model, 'location')->textInput();
        $fields[] = $form->field($model, 'signature')->textInput();
        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('common', 'BasicInfo'), 
                        'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
        
        $fields = [];
        $fields[] = $form->field($model, 'score')->textInput();
        $fields[] = $form->field($model, 'signin_day')->textInput();
        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i>' . Yii::t('user', 'Score'),
            'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
        
        $fields = [];
        $fields[] = $form->field($model, 'image')->textInput()->label(false);
        $fieldGroups[] = ['label' => '<i class="fa fa-file-image-o"></i>' . Yii::t('user', 'Image'),
            'content' =>'<div class="panel panel-primary"><div class="panel-body">'. implode('', $fields).'</div></div>'];
        
        echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
        ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('common', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>