<?php
use yii\helpers\Html;
use modules\post\models\Post;
use app\components\GoLinkPager;
use modules\post\models\PostType;
use yii\bootstrap\Nav;
use yii\widgets\Pjax;
$typeName = Post::PostType($type_id);
$parentType = PostType::getParent($type_id);
$this->title = Yii::t('post', 'Post').' - '.$typeName;
?>
<div class='row'>
	<?php Pjax::begin()?>
	<div class='col-md-9'>
        <div class='panel panel-default'>
        	<?=Nav::widget([
        	        'options' => ['class'=>'nav nav-tabs'],
        	        'items' => [
        	            ['label' => '最多浏览','url'=>['/post/default/show-posts','type_id'=>$type_id]],
        	            ['label' => '最新发布','url'=>['/post/default/show-posts','type_id'=>$type_id,'filter'=>'created_at']],
        	        ],
        	        'encodeLabels' => false,
        	    ]);
        	?>
        	<?= $this->render('@themes/modules/post/default/commonPostList',['res'=>$model]) ?>
        	<?= GoLinkPager::widget(['pagination' => $pages, 'go' => true]); ?>
        </div>
    </div>
    <?php Pjax::end()?>
    <?php if (!Yii::$app->devicedetect->isMobile()):?>
    <div class='col-md-3'>
    	<?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common', 'Create').Yii::t('post', 'Post'),['/post/default/create-post'],['class'=>"btn btn-success btn-block pull-right"])?>
    	<br /><br /><br />
    	<?= $this->render('@themes/modules/post/default/hotPost',['type_id'=>$type_id])?>
    	<?= $this->render('@themes/modules/post/default/categoryPost') ?>
    	<?php //echo $this->render('@themes/modules/post/default/activeUser') ?>
    </div>
    <?php endif;?>
</div>