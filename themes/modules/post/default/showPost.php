<?php
use yii\helpers\Html;
use modules\user\models\User;
use kartik\icons\Icon;
use modules\post\models\PostType;
use app\assets\AppAsset;
AppAsset::addScript($this,"@web/js/lightbox.min.js");
AppAsset::addCss($this,"@web/css/lightbox.css");
$this->title = $post->title;
$parentType = PostType::getParent($post->type_id);
$author = $post->user->username;
?>
<div class='row'>
    <div class='col-md-9'>
        <div class='panel panel-default' style='overflow:hidden'>
            <div class='panel-body'>
            	<h4><b><?= $this->title?></b></h4>
            	<div class='action'>
            		<?= $post->is_essence ? "<i class='fa fa-diamond'></i> ":''?><?= $post->is_reprint ? "<span class='top'>".$post->isReprint."</span>":''?>
					<span class='grey'><?=lulubin\date\DateStyle::widget(['sorce_date'=>$post->created_at])?></span>
					<span><?= Html::a($author,['/user/default/show','username'=>$author],['class'=>'action'])?></span>
					<span class='collection'>
						<?= Html::a(Icon::show($post->isCollect ? 'star':'star-o').$post->collectionNum,['/post/default/collect','id'=>$post->id],
						    ['data-params' => ['id' => $post->id],'data-toggle' => 'tooltip','data-original-title' => $post->isCollect ?'取消收藏':'收藏'])?>
					</span>
            	</div>
            	<div id='content'><?= $post->content?></div>
            	<!-- 微信端打开，不显示分享小部件 -->
            	<?php if (!strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')):?>
    			<?php echo app\widgets\Share::widget()?>
    			<?php endif;?>
            	<?= Yii::$app->params['comment']?$this->render('comment',['post'=>$post,'comment'=>$comment,'comments'=>$comments]):''?>
            </div>
        </div>
        <span>阅读&nbsp;<?php echo $post->trueView?></span>
        <span class="vote">
			<?php echo Html::a(Icon::show($post->isUp ? 'thumbs-up' : 'thumbs-o-up').$post->upNum,['/post/post-vote','id'=>$post->id,'type'=>'post','action'=>'up'],
			    ['title'=>'','class'=>'up','data-toggle'=>"tooltip" ,'data-original-title'=>'顶'])?>
		</span>
    </div>
    <?php if (!Yii::$app->devicedetect->isMobile()):?>
    <div class='col-md-3'>
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common', 'Create').Yii::t('post', 'Post'),['create-post'],['class'=>'btn btn-success btn-block'])?>
        <?php if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == $author):?>
        <?= Html::a('<i class="fa fa-edit"></i> '.Yii::t('common', 'Update').$post->postType,['update-post','id'=>$post->id],['class'=>'btn btn-primary btn-block'])?>
        <?php endif;?>
        <p></p>
        <?= $this->render('@themes/modules/post/default/hotPost',['type_id'=>$post->type_id]) ?>
        <?= $this->render('@themes/modules/post/default/categoryPost') ?>
        <!-- <div class="panel panel-default">
        	<div class='panel-body'>
        		<h3 class='panel-title'>带到手机上看</h3> -->
        		<!-- <div class='panel-body text-center'> --><?php //echo Html::img(Url::to(['/site/qrcode', 'url' => Yii::$app->request->absoluteUrl]),['height'=>'150px']) ?><!-- </div> -->
    		<!-- </div>
        </div> -->
    </div>
    <?php endif;?>
</div>
<?php 
$js = <<<JS
    //bootstrap图自适应，让文章中页面的非gif图片自适应大小
    $(".panel-body").find("#content img").each(function(){
        $(this).addClass("img-responsive");
        $(this).wrap("<a href='"+$(this).attr('src')+"' data-imagelightbox='e'>");
    });
JS;
$this->registerJs($js,\yii\web\View::POS_END);
?>