<?php 
use modules\post\models\Post;
use yii\helpers\Html;
?>
<div class='panel panel-default'>
    <div class='panel-heading'><h3 class='panel-title'>最热文章</h3></div>
	<div class='panel-body'>
		<ul class="post-list">
			<?php $hot = Post::find()->limit('5')->orderBy(['view_num'=>SORT_DESC])->all()?>
			<?php foreach ($hot as $key=>$val):?>
				<li><?= Html::a($val->title,['/post/default/show-post','id'=>$val->id])?></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>