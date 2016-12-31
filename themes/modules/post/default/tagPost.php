<?php 
use yii\helpers\Html;
use modules\post\models\PostTag;
$tags = PostTag::find()->all();
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
    	<h3 class='panel-title'>热门标签</h3>
	</div>
	<div class='panel-body'>
		<ul class="tag-list list-inline">
			<?php foreach ($tags as $key=>$val):?>
				<li>
					<?= Html::a($val->tag_name,['/post/default/show-posts-by-tag','tag_name'=>$val->tag_name],['class'=>'label label-default'])?>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>