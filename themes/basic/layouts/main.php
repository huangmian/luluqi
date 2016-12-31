<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
$title_rail = $this->title?' - ':'';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!-- 文档兼容模式定义，详情 post_id=141 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title).$title_rail.Yii::$app->params['siteName']?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="wrap">
    	<?php
    	   $reflect_class = new \ReflectionClass($this->context);
    	   $parent_controller_id = $reflect_class->getParentClass()->name;
    	   if (strpos($parent_controller_id, 'Back')){
    	       echo $this->render('header_back');
    	   }else {
    	       echo $this->render('header_front');
    	   }
    	?>
        <div class="container">
        	<?=lulubin\pace\Pace::widget(['color'=>'orange','theme'=>'flash']);?>
            <?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
            <?=lulubin\alert\Alert::widget()?>
            <div>
            <?=$content?>
            <?php if (Yii::$app->devicedetect->isMobile()):?>
                <?php $this->beginBlock('test')?>.wrap {padding: 0px;}<?php $this->endBlock()?>
    			<?php $this->registerCss($this->blocks['test'])?>
			<?php endif;?>
            </div>
        </div>
    </div>
    <?php if (!Yii::$app->devicedetect->isMobile()):?><?= $this->render('footer')?><?php endif;?>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>