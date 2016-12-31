<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = Yii::t('user', 'Modify Image');
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-6'>
        <div class='panel panel-default'>
        	<?=$this->render('navRight')?>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin(['id'=>'modifyInfoForm','options' => ['enctype'=>'multipart/form-data']]);?>
                	<?=$image->user->showImage(['width'=>'150','height'=>'150'],'img-rounded');?>
                	<?=$image->user->showImage(['width'=>'100','height'=>'100'],'img-rounded');?>
                	<?=$image->user->showImage(['width'=>'50','height'=>'50'],'img-rounded');?>
                	<p><?=$form->field($image,'image')->fileInput()->label(false)?></p>
                    <?=Html::submitButton('修改',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>