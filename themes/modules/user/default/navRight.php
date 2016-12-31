<?php 
use yii\bootstrap\Nav;
?>
<?= Nav::widget([
    'options' => ['class'=>'nav nav-tabs'],
    'items' => [
        ['label' => Yii::t('user','Info'),'url'=>['/user/default/modify-info']],
        ['label' => Yii::t('user','Modify Image'),'url'=>['/user/default/modify-image']],
        ['label' => Yii::t('user','Modify Password'),'url'=>['/user/default/modify-password']],
        ['label' => '账号绑定','url'=>['/user/default/modify-bind-account']],
    ],
    'encodeLabels' => false,
])?>