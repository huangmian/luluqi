<?php 
use modules\post\models\Post;
use yii\helpers\Html;
use modules\post\models\PostType;
$new = Post::find()->where(['in','type_id',PostType::getSonsId($type_id)])->limit('5')->orderBy(['created_at'=>SORT_DESC])->all();
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
    	<h3 class='panel-title'><?= '最新'.Post::PostType($type_id)?></h3>
	</div>
	<div class='panel-body'>
		<ul class="post-list">
			<?php foreach ($new as $key=>$val):?>
				<li><?= Html::a($val->title,['/post/default/show-post','id'=>$val->id])?></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>