<?php 
use yii\helpers\Html;
?>
<footer class="footer">
	<div class="footer friendly-link">
        <span>友情链接：</span>
    	<?= Html::a('酷站',['/site/cool-site'])?>
    </div>
	<div class="footer friendly-link">
		Copyright © 2016 <a href="https://www.luluqi.cn"><?= Yii::$app->params['siteName']?></a>
        |
        <a href="http://www.yiiframework.com" target="_blank">Yii框架<?= Yii::getVersion() ?></a>
        |
        <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259938527'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1259938527' type='text/javascript'%3E%3C/script%3E"));</script>
	</div>
</footer>
<!-- 滚动条 -->
<a href="#" id="back-to-top" style="display: hidden;"><i class="fa fa-arrow-up back-to-top"></i></a>