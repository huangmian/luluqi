<?php
use yii\helpers\Html;
$this->title = $name;
?>
<!-- <section> 标签定义文档中的节（section、区段）。比如章节、页眉、页脚或文档中的其他部分。 -->
<section class="container site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <!-- nl2br() 函数在字符串中的每个新行（\n）之前插入 HTML 换行符（<br> 或 <br />） -->
    <div class="alert alert-danger"><?= nl2br(Html::encode($message)) ?></div>
    <?= Html::img(Yii::$app->params['imageDomain'].'/other/404.png',['class'=>"img-responsive"])?>
</section>