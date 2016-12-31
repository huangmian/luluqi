<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '绑定本站帐号';
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
        	<div class="panel-heading"><?= Html::encode($this->title) ?></div>
        	<div class="panel-body">
                <?php $form = ActiveForm::begin(['layout' => 'horizontal','id' => 'form-auth-bind-account']); ?>
        		<div class="form-group">
        			<div class="col-sm-6 col-sm-offset-3">您已通过<?= $authInfo['source_name'] ?>登录</div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-sm-3">用户名</label>
        			<div class="col-sm-6" style="padding-top:7px;"><strong><?= isset($authInfo['username'])?$authInfo['username']:$authInfo['name']; ?></strong></div>
        		</div>
        		<div class="form-group">
        			<label class="control-label col-sm-3">还没本站帐号</label>
        			<div class="col-sm-6"><?= Html::a('创建本站帐号并绑定', ['signup'], ['class'=>'btn btn-primary']); ?></div>
        		</div><hr>
        		<div class="form-group">
        			<div class="col-sm-6 col-sm-offset-3">绑定本站账号</div>
    			</div>
                <?= $form->field($model, 'username')->textInput(['maxlength'=>20]); ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength'=>20]); ?>
                <div class="form-group">
        			<div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton('绑定', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
        			&nbsp;&nbsp;<?= Html::a('忘记密码?', ['/user/default/find-password']); ?>
        			</div>
                </div>
                <?php ActiveForm::end(); ?>
        	</div>
        </div>
    </div>	
</div>
