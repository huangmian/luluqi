<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;
$this->title = Yii::t('user', 'Info');
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-6'>
        <div class='panel panel-default'>
        	<?=$this->render('navRight')?>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin(['id'=>'modifyInfo']);?>
                    <?=$form->field($info,'sex')->inline()->radioList(Yii::$app->params['luluyiiGlobal']['sex'])?>
                    <?=$form->field($info,'qq')->textInput()?>
                    <?=$form->field($info,'location')->textInput()?>
                    <?= $form->field($info, 'signature')->textInput()?>
                    <?= $form->field($info, 'birthday')->widget(DatePicker::classname())?>
                    <?=Html::submitButton('修改',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>