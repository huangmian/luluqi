<?php 
use yii\helpers\Html;
?>
<div class='panel-body'>
    <ul class='media-list'>
    <?php foreach ($res as $key=>$value):$user = $value->user;?>
    	<li class='media'>
    		<div class='media-left'>
    			<?= Html::a($user->showImage(['width'=>'60','height'=>'60']),['/user/default/show','username'=>$user->username])?>
    		</div>
    		<div class='media-body'>
    			<div class='media-heading media-action'><?= $user->username?></div>
    			<p>
    				<?= $value->is_essence ? "<i class='fa fa-diamond'></i> ":''?>
    				<?= Html::a($value->title,['/post/default/show-post','id'=>$value->id])?>
    				<?= $value->is_top ? "<span class='top'>".$value->isTop."</span>":''?>
    				<?php //$value->is_reprint ? "<span class='reprint'>".$value->isReprint."</span>":''?>
    			</p>
    			<div class='media-action'><?=lulubin\date\DateStyle::widget(['sorce_date'=>$value->created_at])?></div>
    		</div>
    		<div class="media-right"><?= Html::a("<h4>浏览</h4>".$value->trueView,['/post/default/show-post','id'=>$value->id],['class'=>"btn btn-default"])?></div>
    		<?php if (!Yii::$app->devicedetect->isMobile()):?>
    		<div class="media-right"><?= Html::a("<h4>收藏</h4>".$value->collection,['/post/default/show-post','id'=>$value->id,'#'=>'comment'],['class'=>"btn btn-default"])?></div>
    		<?php endif;?>
    	</li>
    <?php endforeach;?>
    </ul>
</div>