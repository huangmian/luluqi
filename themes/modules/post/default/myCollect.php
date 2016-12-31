<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$this->title = Yii::t('user', 'My Collection');
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('@themes/modules/user/default/navLeft')?></div>
    <?php Pjax::begin()?>
    <div class='col-md-6'>
        <div class='panel panel-default'>
            <div class='panel-heading'><?=Html::encode($this->title)?></div>
            <div class='panel-body'>
            <?php if ($collect):  ?>
            	<ul class='media-list'>
            	<?php foreach ($collect as $key=>$value):?>
        			<li class='media'>
        				<div class='media-left'>
        					<?php $post = $value->post;$user = $post->user;?>
        					<?= Html::a($post->user->showImage(['width'=>'60','height'=>'60']),['/user/default/show','username'=>$user->username])?>
    					</div>
        				<div class='media-body'>
        					<div class='media-heading media-action'>
        						<?= Html::a($post->title,['/post/default/show-post','id'=>$post->id])?>
        					</div>
        					<div class='media-action'>
        						<?= $user->username.' 发布于'.lulubin\date\DateStyle::widget(['sorce_date'=>$post->created_at])?>
        					</div>
        				</div>
        			</li>
            	<?php endforeach;?>
            	</ul>
        	<?php else :?>
        		<p class='text-center'>暂无收藏</p>
        	<?php endif;?>
            </div>
        	<?= LinkPager::widget(['pagination' => $pages]); ?>
        </div>
    </div>
    <?php Pjax::end()?>
</div>