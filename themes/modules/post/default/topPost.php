<?php
use modules\post\models\Post;
use yii\helpers\Html;
$model = Post::find()->where(['is_top'=>1])->orderBy(['is_top'=>SORT_DESC,'view_num'=>SORT_DESC])->all();
?>
<div class='panel panel-default'>
	<div class='panel-heading'>
		<strong><?=Html::encode('置顶推荐 ')?><i class="fa fa-hand-o-left"></i></strong>
	</div>
	<div class='panel-body'>
        <ul class='media-list'>
        <?php foreach ($model as $key=>$value):$user = $value->user;?>
        	<li class='list-group-item col-sm-6'>
        		<div class='media-left'>
        			<?= Html::a($user->showImage(['width'=>'60','height'=>'60']),['/user/default/show','username'=>$user->username])?>
        		</div>
        		<div class='media-body'>
        			<div class='media-heading media-action'><?= $user->username?></div>
        			<p>
        				<?= $value->is_essence ? "<i class='fa fa-diamond'></i> ":''?>
        				<?= Html::a(mb_strlen($value->title)>20?mb_substr($value->title,0,20,'utf-8').'...':$value->title,['/post/default/show-post','id'=>$value->id])?>
        			</p>
        			<div class='media-action'><?=\lulubin\date\DateStyle::widget(['sorce_date'=>$value->created_at])?></div>
        		</div>
        	</li>
        <?php endforeach;?>
        </ul>
	</div>
	<?=$this->render('@themes/modules/post/default/newPost')?>
</div>