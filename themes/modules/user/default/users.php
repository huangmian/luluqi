<?php
use yii\helpers\Html;
use modules\user\models\UserInfo;
$action_id = Yii::$app->controller->action->id;
switch ($action_id){
    case 'users':
        $this->title = '活跃用户';
        break;
    case 'online-user':
        $this->title = '在线用户';
        break;
    case 'search-user':
        $this->title = Yii::t('user', 'User').Yii::t('common', 'Search Result');
        break;
    default:
        return true;
}
?>
<div id="search-users" class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Html::encode($this->title).Html::a('（会员在线人数：'.UserInfo::OnlineUser()->count().'）','/user/default/online-user')?></strong>
        <form class='pull-right'>
        	<input type="text" name="username" placeholder='搜索用户...' />
    	</form>
    </div>
    <div class="panel-body row">
	<?php if ($res):  ?>
        <?php foreach ($res as $key => $val): ?>
            <div class="col-md-2">
            	<div class='media user-card'>
            	<?php if ($action_id == 'online-user'): $username = $val->user['username'];?>
            		<div class='media-left'>
            			<?= Html::a($val->user->showImage(['width'=>'60','height'=>'60']),['default/show','username'=>$username])?>
            		</div>
            		<div class='media-body'>
            			<div class='media-heading'><?= Html::a($username,['default/show','username'=>$username])?></div>
            			<div class='media-action'><?= '积分:'.$val->id?></div>
            		</div>
        		<?php else :?>
                    <div class='media-left'>
                    	<?= Html::a($val->showImage(['width'=>'60','height'=>'60']),['default/show','username'=>$val['username']])?>
                    </div>
                    <div class='media-body'>
                    	<div class='media-heading'><?= Html::a($val['username'],['default/show','username'=>$val['username']])?></div>
                    	<div class='media-action'><?= '积分:'.$val['userInfo']['score']?></div>
                    </div>
        		<?php endif;?>
            	</div>
            </div>
        <?php endforeach ?>
    <?php else :?>
		<p class='text-center'>没有相关用户</p>
	<?php endif;?>
    </div>
</div>