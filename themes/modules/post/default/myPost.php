<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$action_id = Yii::$app->controller->action->id;
$this->title = Yii::t('user', 'My Release');
?>
<div class='row'>
    <?php if ($action_id=='my-post'):?>
    	<div class='col-md-3'><?= $this->render('@themes/modules/user/default/navLeft')?></div>
    <?php else :?>
    	<?= $this->render('@themes/modules/user/default/show',['user'=>$user])?>
    <?php endif;?>
    <?php Pjax::begin()?>
    <div class='col-md-6'>
        <div class='panel panel-default'>
            <div class='panel-heading'><?=Html::encode($this->title)?></div>
            <div class='panel-body'>
            <?php if ($post):  ?>
            	<ul class='media-list'>
            	<?php foreach ($post as $key=>$value):?>
        			<li class='media'>
        				<div class='media-body'>
        					<div class='media-heading media-action'>
        						<?= Html::a($value->title,['/post/default/show-post','id'=>$value->id])?>
        						<span class='pull-right'><?=lulubin\date\DateStyle::widget(['sorce_date'=>$value->created_at])?></span>
        					</div>
        				</div>
        			</li>
            	<?php endforeach;?>
            	</ul>
        	<?php else :?>
        		<p class='text-center'>暂无发布</p>
        	<?php endif;?>
            </div>
            <?= LinkPager::widget(['pagination'=>$pages])?>
            <!--   LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '下一页', 
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'hideOnSinglePage' => false,//如果你的数据过少，不够2页，默认不显示分页，如果你需要，设置hideOnSinglePage=false即可
                'maxButtonCount' => 5,
            ]); --> 
        </div>
    </div>
    <?php Pjax::end()?>
</div>