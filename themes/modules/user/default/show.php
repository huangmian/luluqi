<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use modules\user\models\UserFans;
use yii\helpers\Url;
$action_id = Yii::$app->controller->action->id;
if ($action_id=='show'){
    $this->title = $user->username;
}
$user_id = $action_id=='show-post'?"（".$user->id."）":"（第".$user->id."位会员）";
$user_info = $user->userInfo;
?>
<?php if (in_array($action_id, ['show','show-focus','show-fans','show-user-post'])):?>
	<div class='col-md-4'>
<?php endif;?>
<?php if($user_info): ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?=$user->username.$user_id?>
		<?php if (Yii::$app->user->isGuest || \Yii::$app->user->identity->username !== $user->username):?>
			<?= Html::a('<i class="fa fa-envelope"></i> 私信',['/user/default/send-message','username' => $user->username],['class'=>"btn btn-primary btn-xs pull-right"])?>
    		<span class='focus pull-right'>
        		<?php if (Yii::$app->user->isGuest || !UserFans::exitFocus($user->username)):?>
        			<?= Html::a('<i class="fa fa-plus"></i> <b>关注</b>',['/user/default/focus','username' => $user->username],['class'=>"btn btn-success btn-xs"])?>
        		<?php else:?>
        			<?= Html::a('<i class="fa fa-minus"></i> <b>取消关注</b>',['/user/default/focus','username' => $user->username],['class'=>"btn btn-danger btn-xs"])?>
        		<?php endif;?>
    		</span>
		<?php else:?>
			<?= Html::a('<i class="fa fa-envelope"></i> 私信',null,['class'=>"btn btn-primary btn-xs pull-right disabled"])?>
			<?= Html::a('<i class="fa fa-plus"></i> 关注',null,['class'=>"btn btn-success btn-xs pull-right disabled"])?>
		<?php endif;?>
		</div>
		<?= DetailView::widget([
            'model' => $user_info,
		    'id' => 'a',
            'attributes' => [
                [
                    'attribute' => 'image',
                    'format' => [
                        'image',
                        ["width"=>"84","height"=>"84"]],
                    'value' => Yii::$app->params['imageDomain'].'/'.$user_info['image']
                ],
                'score',
                [
                    'attribute' => '文章数量',
                    'format' => 'raw',
                    'value' => '<span class="badge">'.$user->userPostNum.'</span>'.Html::a('全部文章',['/post/default/show-user-post','user_id'=>$user_info['user_id']],['class'=>'pull-right'])
                ],
                [
                    'attribute' => '粉丝数量',
                    'format' => 'raw',
                    'value' => '<span class="badge">'.$user->fansNum.'</span>'.Html::a(Yii::t('user', 'All Fans'),['/user/default/show-fans','username'=>$user->username],['class'=>'pull-right'])
                ],
                [
                    'attribute' => '关注数量',
                    'format' => 'raw',
                    'value' => '<span class="badge">'.$user->focusNum.'</span>'.Html::a(Yii::t('user', 'All Focus'),['/user/default/show-focus','username'=>$user->username],['class'=>'pull-right'])
                ],
                [
                    'attribute' => 'sex',
                    'value' => $user_info['sexName'],
                    //当$user_info->sex不为空的时候才会显示
                    //"visible" => $user_info->sex !== NUll,
                ],
                'location',
                'qq',
                'birthday',
                'signature',
                [
                    'attribute' => Html::getAttributeName('last_login_time'),
                    'value' => lulubin\date\DateStyle::widget(['sorce_date'=>$user_info['last_login_time']])
                ],
                [
                    'attribute' => '注册时间',
                    'value' => lulubin\date\DateStyle::widget(['sorce_date'=>$user->created_at])
                ]
            ],
         ]) ?>
	</div>
<?php endif;?>
<?php if (in_array(Yii::$app->controller->action->id, ['show','show-focus','show-fans','show-user-post'])):?>
	</div>
<?php endif;?>
<?php $this->beginBlock('showJS')?>
	//关注和取消关注
    $('.focus a').on('click', function() {
    	if("<?=Yii::$app->user->isGuest?>"){
    		location.href = "<?=Url::toRoute(['/user/default/login'])?>";
    		return false;
    	}
        var a = $(this);
        var i = a.find('i');
        var b = a.find('b');
        var params = a.data('params');
        $.ajax({
            url: a.attr('href'),
            type:'post',
            data:params,
            dataType: 'json',
            success: function(data) {
                if(data.action == 'focus') {
                    i.attr('class', 'fa fa-minus');
                    a.attr('class', 'btn btn-danger btn-xs');
                    b.html('取消关注');
                } else {
                    i.attr('class', 'fa fa-plus');
                    a.attr('class', 'btn btn-success btn-xs');
                    b.html('关注');
                }
            },
            error: function () {
            	alert('网络错误，请稍后重试');
            }
        });
        return false;
    });
<?php $this->endBlock()?>
<?php $this->registerJS($this->blocks['showJS'],\yii\web\View::POS_END)?>