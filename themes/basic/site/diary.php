<?php
$this->title = '成长日记';
use app\assets\AppAsset;
use yii\helpers\Html;
AppAsset::addCss($this, '@web/css/timeline.css')
?>
<section id="site-diary-timeline" class="cd-container">
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-movie">
			<img src="/images/timeline/./cd-icon-location.svg" alt="Location">
		</div>
		<div class="cd-timeline-content">
			<ul>
                <li>Hello,I'm lulubin</li>
                <li><a href="#"><i class="fa fa-qq" style="font-size:17px"></i> QQ群453300767</a></li>
                <li><a href="https://github.com/lulubin/luluyii" target="_blank"><i class="fa fa-github-alt" style="font-size:17px"></i> 源代码</a></li>
            </ul>
            <span class="cd-date">关于我</span>
		</div>
	</div>
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-picture">
			<img src="/images/timeline//cd-icon-picture.svg" alt="Picture">
		</div>
		<div class="cd-timeline-content">
			<p class='text-center'>
                <?=Html::img(Yii::$app->params['imageDomain'].'/other/wechat.png',['width'=>'240px'])?>
            </p>
			<span class="cd-date">网站的长期发展离不开各位的支持</span>
		</div>
	</div>
</section>
<?php 
$js = <<<JS
    $(".diary-day").html($("section").find('li').length);
JS;
$this->registerJs($js);
?>