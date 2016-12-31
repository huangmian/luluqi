<?php 
use yii\helpers\Html;
use modules\post\models\PostType;
$types = PostType::findAll(['parent_id'=>0]);
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
    	<h3 class='panel-title'>文章分类</h3>
	</div>
	<div class='panel-body'>
		<ul class="post-list">
			<?php foreach ($types as $key=>$val):?>
				<li><?= Html::a($val->name,['/post/default/show-posts','type_id'=>$val->type_id])?>
					<ul>
					<?php foreach ($val->sons as $key=>$val):?>
						<li><?= Html::a($val->name,['/post/default/show-posts','type_id'=>$val->type_id])?></li>
					<?php endforeach;?>
					</ul>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>