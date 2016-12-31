<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = '重置密码';
?>
<div class='row'>
    <div class='col-md-4 col-md-offset-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <h3 class='panel-title'><?=Html::encode($this->title);?></h3>
            </div>
            <div class='panel-body'>
                <?php $form=ActiveForm::begin(['id'=>'resetPasswordForm']);?>
                    <?= $form->field($model,'new_password')->passwordInput()?>
                    <?= $form->field($model,'renew_password')->passwordInput()?>
                    <?= Html::submitButton('保存',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>