<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$this->title = Yii::t('post', 'Post').Yii::t('common', 'Search Result');
?>
<div class='row'>
	<?php Pjax::begin()?>
	<div class='col-md-9'>
		<div class='panel panel-default'>
            <div class='panel-heading'>
            	<strong>"<?=$title?>"搜索到(　<span class='text-red'><?=$count?></span>)个结果</strong>
            </div>
            <div class='panel-body'>
            <?php if ($res):?>
            	<?= $this->render('@themes/modules/post/default/commonPostList',['res'=>$res]) ?>
        	<?php else :?>
        		<p class='text-center'>没有搜索到关于"<?=$title?>"的文章</p>
        	<?php endif;?>
            </div>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
        </div>
	</div>
	<?php Pjax::end()?>
	<div class='col-md-3'>
		<?= $this->render('@themes/modules/post/default/categoryPost') ?>
		<?= $this->render('@themes/modules/post/default/bestHotPost') ?>
	</div>
</div>