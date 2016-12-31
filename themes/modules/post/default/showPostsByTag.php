<?php
use yii\helpers\Html;
use modules\post\models\Post;
use app\components\GoLinkPager;
$this->title = Yii::$app->request->get('tag_name');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='row'>
	<div class='col-md-9'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
            	<?=Html::encode($this->title)?>
            	<?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common', 'Create').Yii::t('post', 'Post'),['/post/default/create-post'],['class'=>"btn btn-success btn-xs pull-right"])?>
            </div>
            <div class='panel-body'>
            	<?= $this->render('@themes/modules/post/default/commonPostList',['res'=>$tags]) ?>
            </div>
            <?= GoLinkPager::widget(['pagination' => $pages, 'go' => true]); ?>
        </div>
    </div>
    <div class='col-md-3'>
    	<?= $this->render('@themes/modules/post/default/tagPost') ?>
    </div>
</div>