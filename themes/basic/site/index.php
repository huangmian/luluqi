<?php
use yii\helpers\Html;
use modules\user\models\form\SigninForm;
use modules\user\models\Visit;
use modules\post\models\Post;
use modules\user\models\User;
use modules\user\models\VisitDay;
use modules\post\models\PostComment;
use yii\widgets\Pjax;
use yii\helpers\Url;
use modules\post\models\PostTag;
$this->metaTags[] = '<meta name="Keywords" content="Yii Framework,luluyii学院,yii资源,php资源"/>';
$this->metaTags[] = '<meta name="Description" content="luluyii学院（yii中文学习站）为yii爱好者提供全面的yii资料、最新最全的yii应用、全面的yii指导、实用扩展推荐，我们一直致力为你的yii学习提供动力。"/>';
$date = date('Y年m月d日',time());
$build_time = '2016-05-18';
$last_update_time = Post::find()->orderBy(['created_at'=>SORT_DESC])->select('created_at')->asArray()->one()['created_at'];
$run_day = floor((time()-strtotime($build_time))/86400);
?>
<div class='row'>
	<?php Pjax::begin()?>
    <div class='col-md-9'>
        <?= $this->render('@themes/modules/post/default/newPost')?>
    </div>
    <?php Pjax::end()?>
    <?php if (!Yii::$app->devicedetect->isMobile()):?>
    <div class='col-md-3'>
    	<div class="btn-group btn-group-justified">
    		<?php if (SigninForm::isNotSignin()):?>
            	<?= Html::a('<i class="fa fa-calendar-plus-o"></i> 点此处签到<br>签到有好礼','javascript:void(0)',['class'=>"btn-registration btn btn-success"])?>
            <?php else :?>
            	<?= Html::a('<i class="fa fa-calendar-check-o"></i>  今日已签到<br>已连续'.SigninForm::siginDay().'天','javascript:void(0)',['class'=>"btn btn-success disabled"])?>
            <?php endif;?>
    		<?= Html::a($date.'<br>已有<b class="sign-num">'.SigninForm::siginNum().'</b>人签到',['/user/default/signin-member'],['class'=>"btn btn-primary"])?>
        </div><br/>
        <div class="btn-group btn-group-justified">
        	<?= Html::a('<p>今日访问：'.VisitDay::visitNum().'  在线人数：'.VisitDay::OnlineNum().'</p>建站以来已有'.Visit::visitNum().'人访问'.Yii::$app->params['siteName'],['/user/default/show-visit'],['class'=>"btn btn-primary"])?>
        </div><br/>
        <?= $this->render('@themes/basic/site/carousel') ?>
        <?= $this->render('@themes/modules/post/default/tagPost') ?>
        <?= $this->render('@themes/modules/post/default/categoryPost') ?>
        <?= $this->render('@themes/modules/post/default/bestHotPost') ?>
		<div class='panel panel-default'>
            <div class='panel-heading'><h3 class='panel-title'><?= Yii::$app->params['siteName'].' 运行状况'?></h3></div>
        	<div class='panel-body'>
        		<span class="lu-label">文章总数：</span><span class="lu-info"><?= Post::find()->count()?>&nbsp;篇</span>
        		<span class="lu-label">评论总数：</span><span class="lu-info"><?= PostComment::find()->count()?>&nbsp;个</span>
        		<span class="lu-label">标签数量：</span><span class="lu-info"><?= PostTag::find()->count()?>&nbsp;个</span>
        		<span class="lu-label">会员总数：</span><span class="lu-info"><?= Html::a(User::find()->where(['status' => 10])->count(),['/user/default/users'])?>&nbsp;位</span>
        		<span class="lu-label">建站日期：</span><span class="lu-info"><?= $build_time?></span>
        		<span class="lu-label">运行天数：</span><span class="lu-info"><?= $run_day?>&nbsp;天</span>
        		<span class="lu-label">最后更新：</span><span class="lu-info"><?= date('Y-m-d',$last_update_time)?></span>
        	</div>
		</div>
    </div>
    <?php endif;?>
</div>
<?php $this->beginBlock('indexJS')?>
	// 签到
    $('.btn-registration').click(function() {
    	if("<?=Yii::$app->user->isGuest?>"){
    		location.href = "<?=Url::toRoute(['/user/default/login'])?>";
    		return false;
    	}
        var a = $(this);
        var params = a.data('params');
        $.ajax({
            url: '/user/default/signin',
            type:'post',
            data:params,
            dataType: 'json',
            success: function(data) {
            	a.html('<i class="fa fa-calendar-check-o"></i> 今日已签到<br />已连续' + data.days + '天').removeClass('btn-registration').addClass('disabled');
            	$(".sign-num").html(parseInt($(".sign-num").html())+1);
            },
            error: function () {
                alert('网络错误，请稍后重试');
            }
        });
        return false;
    });
<?php $this->endBlock()?>
<?php $this->registerJS($this->blocks['indexJS'],\yii\web\View::POS_END)?>