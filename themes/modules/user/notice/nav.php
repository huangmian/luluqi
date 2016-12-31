<?php 
use yii\bootstrap\Nav;
?>
<?= Nav::widget([
    'options' => ['class'=>'nav nav-tabs'],
    'items' => [
        ['label' => Yii::t('user','Notice'),'url'=>['/user/notice']],
        ['label' => Yii::t('user','System'),'url'=>['/user/notice/system']],
        ['label' => Yii::t('user','Message'),'url'=>['/user/notice/message']],
        ['label' => Yii::t('user','Focus'),'url'=>['/user/notice/focus']],
        ['label' => Yii::t('user','Visit'),'url'=>['/user/notice/visit']],
        ['label' => Yii::t('post','Collection'),'url'=>['/user/notice/collection']],
        ['label' => Yii::t('post','Comment'),'url'=>['/user/notice/comment']],
        ['label' => Yii::t('post','Action'),'url'=>['/user/notice/vote']],
    ],
    'encodeLabels' => false,
])?>