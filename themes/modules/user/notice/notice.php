<?php 
use yii\helpers\Html;
use modules\user\models\UserNotice;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\widgets\Pjax;
$this->title = Yii::t('user', 'My Notice');
$user_id = Yii::$app->user->id;
$count = UserNotice::find()->where(['to_user_id'=>$user_id,'type'=>$type?$type:0])->count();
$pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['many']]);
$notices = UserNotice::find()->where(['to_user_id'=>$user_id,'is_read'=> 1,'type'=>$type?$type:0])->orderBy(['created_time'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
?>
<div class='row'>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <?php Pjax::begin()?>
	<div class='col-md-9'>
        <div class="panel panel-default">
        	<?= $this->render('/notice/nav')?>
            <div class='panel-body'>
        	<?php if ($notices):  ?>
            	<ul class='media-list'>
            	<?php foreach ($notices as $key=>$value):?>
        			<li class='media'>
        				<div class='media-left'>
        					<?= Html::a($value->fromUser->showImage(['width'=>'45','height'=>'45'],'img-rounded'),['default/show','username'=>$value->fromUser->username])?>
        				</div>
        				<div class='media-body'>
        					<div class='media-heading media-action'>
        						<?= Html::a($value->fromUser->username,['default/show','username'=>$value->fromUser->username])?> 
        						<?= $value->noticeZh?>
        					</div>
        					<p>
        						<?= $value->message['content']?><?= $value->comment['desc']?>
        						<?= Html::a($value->collection['post']['title'],['/post/default/show-post','id'=>$value->collection['post_id']])?>
        						<?php if ($value->vote['type']=='post'):?>
        							<?= Html::a($value->vote['typeModel']['title'],['/post/default/show-post','id'=>$value->vote['typeModel']['id']])?>
        						<?php else :?>
        							<?= Html::a($value->vote['typeModel']['desc'],['/post/default/show-post','id'=>$value->vote['typeModel']['post_id'],'#'=>'comment'])?>
        						<?php endif;?>
        					</p>
        					<div class='media-action'>
        						<?=lulubin\date\DateStyle::widget(['sorce_date'=>$value->created_time])?>
        						<span class='pull-right'>
        							<?= Html::a($value->noticeTage,$value->noticeUrl)?>
        						</span>
        					</div>
        				</div>
        			</li>
            	<?php endforeach;?>
            	</ul>
        	<?php else :?>
        		<p class='text-center'>暂无消息</p>
        	<?php endif;?>
            </div>
            <?= LinkPager::widget(['pagination'=>$pages])?>
        </div>
        <?php Pjax::end()?>
    </div>
</div>