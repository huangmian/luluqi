<?php 
use modules\post\models\Post;
use yii\helpers\Html;
$active_user = Post::find()->groupBy('user_id')->having('count(*)>1')->orderBy(['count(*)'=>SORT_DESC])->select('user_id')->all();
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
    	<h3 class='panel-title'>活跃会员</h3>
	</div>
	<div class="panel-body row">
    <?php foreach ($active_user as $key => $val): $user = $val->user;?>
		<span><?= Html::a($user->showImage(['width'=>'45','height'=>'45']),['default/show','username'=>$user['username']],['title'=>$user['username']])?></span>
    <?php endforeach ?>
    </div>
</div>