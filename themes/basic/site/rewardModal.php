<?php
use yii\helpers\Html;
$this->title = '打赏支持';
?>
<p class='text-center'>如果觉得我的文章对您有用，请随意打赏。您的支持将鼓励我继续创作！</p>
<?=Html::img(Yii::$app->params['imageDomain'].'/other/wechat.png',['width'=>'250px'])?>
<?=Html::img(Yii::$app->params['imageDomain'].'/other/alipay.png',['width'=>'280px'])?>