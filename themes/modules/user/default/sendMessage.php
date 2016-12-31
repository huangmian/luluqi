<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = Yii::t('user', 'Send Message');
$adminName = '';
foreach (Yii::$app->params['adminName'] as $key=>$val){
    $adminName .= $val.',';
}
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-6'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <?=Html::encode($this->title)?>
                <?= Html::a('<i class="fa fa-arrow-left"></i> 返回列表',['/user/default/list-message'],['class'=>'btn btn-xs btn-success pull-right'])?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin(['id'=>'sendMessageForm']);?>
                    <?=$form->field($model,'username')->textInput(['placeholder'=>'管理员有'.$adminName,'value'=>$username])?>
                    <?=$form->field($model,'message')->textInput()?>
                    <?=Html::submitButton('发送',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>