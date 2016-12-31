<?php
use yii\helpers\Html;
use modules\user\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = Yii::t('user', 'View Message');
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
            	<ul class='media-list' id="ViewMessage">
            		<li class='media'>
        				<div class='media-left'>
        					<?= Html::a($message->fromUser->showImage(['width'=>'45','height'=>'45'],'img-rounded'),['default/show','username'=>$message->from])?>
    					</div>
        				<div class='media-body'>
        					<div class='media-heading media-action'><?= Html::a($message->from,['default/show','username'=>$message->from]).' 发布于'.date('Y-m-d H:i',$message->send_time) ?></div>
        					<p><?= $message->content?></p>
        				</div>
        			</li>
            		<?php foreach ($message->sons as $key=>$value):?>
        			<li class='media'>
        				<div class='media-left'>
        					<?= Html::a($value->fromUser->showImage(['width'=>'45','height'=>'45'],'img-rounded'),['default/show','username'=>$value->from])?>
    					</div>
        				<div class='media-body'>
        					<div class='media-heading media-action'><?= Html::a($value->from,['default/show','username'=>$value->from]).' 发布于'.date('Y-m-d H:i',$value->send_time) ?></div>
        					<p><?= $value->content?></p>
        				</div>
        			</li>
            		<?php endforeach;?>
            		<h5>回复私信</h5><hr />
            		<?php $form = ActiveForm::begin(['action'=>Url::toRoute(['/user/default/view-message','id'=>$message->id])]);?>
                        <?=$form->field($model,'content')->textarea()->label(false)?>
                        <?=Html::submitButton('回复',['class'=>'btn btn-primary'])?>
                	<?php ActiveForm::end();?>
            	</ul>
            </div>
        </div>
    </div>
</div>