<?php
use yii\helpers\Url;
?>
<div class='panel panel-default'>
    <div class='panel-heading'>站长推荐</div>
    <div id="myCarousel" class="carousel slide">
       <!-- 轮播（Carousel）项目 -->
       <div class="carousel-inner">
          <div class="item text-center">
             <a href="<?=Url::toRoute(['/post/default/show-post','id'=>1])?>"><img src="<?= Yii::$app->params['imageDomain'].'/carousel/01.png'?>"></a>
             <span style="color:red">基于yii2的小系统</span>
          </div>
          <div class="item text-center active">
             <a href="<?=Url::toRoute(['/post/default/show-post','id'=>2])?>"><img src="<?= Yii::$app->params['imageDomain'].'/carousel/03.png'?>"></a>
             <span style="color:red">QQ、微博、Github、微信第三方登录</span>
          </div>
          <div class="item text-center">
             <a href="<?=Url::toRoute(['/post/default/show-post','id'=>3])?>"><img src="<?= Yii::$app->params['imageDomain'].'/carousel/02.png'?>"></a>
             <span style="color:red">创建yii扩展</span>
          </div>
       </div>
       <!-- 轮播（Carousel）导航 -->
       <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
       <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div> 