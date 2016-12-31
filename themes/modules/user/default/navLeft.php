<?php
use yii\helpers\Html;
use yii\widgets\Menu;
$user = Yii::$app->user->identity;
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <h3 class='panel-title'><?= $user->showImage()?>  <strong><?=Html::encode($user->username)?></strong></h3>
    </div>
    <div class='panel-body'>
        <?=Menu::widget([
            /* 胶囊行导航 nav nav-pills */
            /* 垂直堆叠的导航 nav nav-pills nav-stacked*/
            'options' => ['class'=>'nav nav-pills nav-stacked'],
            'items' => [
                ['label' => '<i class="fa fa-cog"></i> '.Yii::t('user','Setting'),'url'=>['/user/default/modify-info']],
                ['label' => '<i class="fa fa-bell"></i> '.Yii::t('user', 'My Notice'),'url'=>['/user/notice']],
                ['label' => '<i class="fa fa-database fa-fw"></i> '.Yii::t('user', 'Score Focus'),'url'=>['/user/default/show-score']],
                ['label' => '<i class="fa fa-envelope"></i> '.Yii::t('user', 'My Message'),'url'=>['/user/default/list-message']],
                ['label' => '<i class="fa fa-star"></i> '.Yii::t('user', 'My Collection'),'url'=>['/post/default/my-collect']],
                ['label' => '<i class="fa fa-list"></i> '.Yii::t('user', 'My Release'),'url'=>['/post/default/my-post']],
            ],
            'encodeLabels' => false,
        ])?>
    </div>
</div>