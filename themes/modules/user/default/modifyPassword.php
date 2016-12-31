<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = Yii::t('user', 'Modify Password');
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-6'>
        <div class='panel panel-default'>
            <?=$this->render('navRight')?>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin(['id'=>'modifyPasswordForm']);?>
                    <?=$form->field($model,'old_password')->passwordInput()?>
                    <?=$form->field($model,'new_password')->passwordInput()?>
                    <?=$form->field($model,'renew_password')->passwordInput()?>
                    <?=Html::submitButton('修改',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>