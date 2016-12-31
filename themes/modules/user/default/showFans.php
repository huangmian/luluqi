<?php
use yii\helpers\Html;
use modules\user\models\User;
$user = User::findOne(['username'=>Yii::$app->request->get('username')]);
$action_id = Yii::$app->controller->action->id;
?>
<div class='row'>
	<?= $this->render(in_array($action_id, ['show-fans','show-focus'])?'/default/show':'/default/showScore',['user'=>$user])?>
    <div class='col-md-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <h3 class='panel-title'><?=Html::encode($action_id=='show-fans'?Yii::t('user', 'All Fans'):Yii::t('user', 'All Focus'))?></h3>
            </div>
            <div class='panel-body'>
            	<ul class='media-list'>
        			<?php foreach ($action_id=='show-fans'?$user->showFans:$user->showFocus as $key=>$value):?>
    				<li class='media'>
    					<div class='media-left'>
    						<?= Html::a($user->showImage(['width'=>'60','height'=>'60']),['default/show','username'=>$value->from])?>
    					</div>
    					<div class='media-body'>
    						<div class='media-heading'><?= Html::a($value->from,['default/show','username'=>$value->from])?></div>
    						<div class='media-action'>
    							<?= \lulubin\date\DateStyle::widget(['sorce_date'=>$value->focus_time])?>
    						</div>
    					</div>
    				</li>
        			<?php endforeach;?>
            	</ul>
            </div>
        </div>
    </div>
</div>