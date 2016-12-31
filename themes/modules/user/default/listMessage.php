<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$this->title = Yii::t('user', 'My Message');
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <?php Pjax::begin()?>
    <div class='col-md-6'>
        <div class='panel panel-default'>
        	<div class='panel-heading'>
            	<?=Html::encode($this->title)?>
            	<?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('user', 'Send Message'),['/user/default/send-message'],['class'=>'btn btn-xs btn-success pull-right'])?>
            </div>
            <div class='panel-body'>
        	<?php if ($message):  ?>
            	<ul class='media-list' id="listMessage">
            	<?php foreach ($message as $key=>$value):?>
        			<li class='media'>
        				<div class='media-left'>
        					<?= Html::a($value->fromUser->showImage(['width'=>'45','height'=>'45'],'img-rounded'),['default/show','username'=>$value->from])?>
    					</div>
        				<div class='media-body'>
        					<div class='media-heading media-action'><?= Html::a($value->from,['default/show','username'=>$value->from])?></div>
        					<p><?= $value->content?></p>
        					<div class='media-action'>
        						<?=lulubin\date\DateStyle::widget(['sorce_date'=>$value->send_time])?>
        						<span class='pull-right'>
        							<?= Html::a('回复('.$value->sonsNum.')',['default/view-message','id' => $value->id])?>
								</span>
        					</div>
        				</div>
        			</li>
            	<?php endforeach;?>
            	</ul>
        	<?php else :?>
        		<p class='text-center'>暂无私信</p>
        	<?php endif;?>
            </div>
            <?= LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
    <?php Pjax::end()?>
</div>