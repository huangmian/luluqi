<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use lulubin\oauth\assets\AuthChoiceAsset;
AuthChoiceAsset::register($this);
$this->title = Yii::t('user', 'Login');
?>
<!-- 缓存Get请求的div -->
<div id='login' class='row'>
	<div class='col-md-4 col-md-offset-4'>
		<div class='panel panel-default'>
			<div class='panel-heading'>
			     <h3 class='panel-title'><?= Html::encode($this->title);?></h3>
			</div>
			<div class='panel-body'>
			     <?php $form = ActiveForm::begin(['id'=>'loginForm']);?>
                    <?=$form->field($model,'username')->textInput(['placeholder'=>$model->getAttributeLabel('username')])?>
                    <?=$form->field($model,'password')->passwordInput(['placeholder'=>$model->getAttributeLabel('password')])?>
                    <?=$form->field($model,'rememberMe')->checkbox(['template'=>
                        "<div class=\"checkbox\">\n".Html::a('忘记密码?',['/user/default/find-password'],['class'=>'pull-right']).
                        "{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"])?>
                    <?=Html::submitButton($this->title,['class'=>'btn btn-block btn-primary'])?><br />
                    <div class="form-group other-way text-center">
                    	<?=Html::a('',['/user/default/auth','authclient'=>'qq'],['class'=>'qq'])?>
                    	<?=Html::a('',['/user/default/auth','authclient'=>'weibo'],['class'=>'weibo'])?>
                    	<?=Html::a('',['/user/default/auth','authclient'=>'github'],['class'=>'github'])?>
				  	</div>
			     <?php ActiveForm::end();?>
			</div>
		</div>
	</div>
</div>