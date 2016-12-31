<?php
use app\assets\AppAsset;
AppAsset::addScript($this, '@web/layui/layui.js');
$this->title = '酷站';
$path = Yii::$app->params['imageDomain'].'/coolSite/';
//通过谷歌提供的服务获取网页的图标—— http://www.google.com/s2/favicons?domain=
?>
<div id="tool" class='panel panel-default'>
	<div class='panel-heading'><strong>开发工具</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>GitHub.png"><a href="https://github.com">GitHub</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Bitbucket.png"><a href="https://bitbucket.org">Bitbucket</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Packagist.png"><a href="https://packagist.org">Packagist</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Composer.png"><a href="http://docs.phpcomposer.com">Composer</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Git.png"><a href="https://git-scm.com">Git</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Smartgit.png"><a href="http://www.syntevo.com/smartgit/download">Smartgit</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.phpstudy.net">phpstudy</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Zend.png"><a href="http://www.zend.com">Zend</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>腾讯云.png"><a href="https://www.qcloud.com">腾讯云</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>阿里云.png"><a href="https://www.aliyun.com">阿里云</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>站长工具.png"><a href="http://tool.chinaz.com">站长工具</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度.png"><a href="http://zhanzhang.baidu.com">百度站长平台</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>草料二维码生成器.png"><a href="http://cli.im">草料二维码生成器</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>黑客攻击趋势.png"><a href="http://map.norsecorp.com">黑客攻击趋势</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>CNZZ.png"><a href="https://www.cnzz.com">CNZZ</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>netcraft.png"><a href="https://www.netcraft.com">netcraft</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>startssl.png"><a href="https://www.startssl.com">startssl</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>CDN.png"><a href="http://www.bootcdn.cn">CDN</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>百度脑图.png"><a href="http://naotu.baidu.com">百度脑图</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>有道翻译.png"><a href="http://fanyi.youdao.com">有道翻译</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>懒人工具箱.png"><a href="http://tool.lanrentuku.com/jsformat/">JS/HTML格式化工具</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>若水软件工作室.png"><a href="http://rssws.net">若水软件工作室</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>DCloud.png"><a href="http://www.dcloud.io">DCloud</a></div>
	</div>
</div>
<div id="tool" class='panel panel-default'>
	<div class='panel-heading'><strong>Local</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://127.0.0.1/gocool/test.php">test</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://127.0.0.1/365yi/wx.php">365衣柜</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.demo.com">纳贝商城</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://admin.demo.com">wocx</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.luluyii.com">luluyii</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.basic.com">basic</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.nabermall.com">纳贝商城（在线）</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://admin.nabermall.com">wocx（在线）</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://121.41.167.34/coolshop">购酷（在线）</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Teambition.png"><a href="https://www.teambition.com">Teambition（在线）</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>3D试衣间.png"><a href="http://115.28.163.127/3d/wx.html">3D试衣间（在线）</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>好买衣.png"><a href="https://haomaiyi.ews.m.jaeapp.com/dist/startpage.html">好买衣（在线）</a></div>
	</div>
</div>
<div id="php" class='panel panel-default'>
	<div class='panel-heading'><strong>html & js</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>jQuery插件库.png"><a href="http://www.jq22.com">jQuery插件库</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.ijquery.cn">爱上JQuery</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>素材火.png"><a href="http://www.sucaihuo.com">素材火</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>模板之家.png"><a href="http://www.cssmoban.com">模板之家</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.jqueryfuns.com">jQueryFuns</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>jQuery之家.png"><a href="http://www.htmleaf.com">jQuery之家</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>bootsnipp.png"><a href="http://bootsnipp.com">bootsnipp</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>layer.png"><a href="http://layer.layui.com">layer</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Angular JS.png"><a href="http://www.ngnice.com">Angular JS</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://frozenui.github.io">FrozenUI</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>bootstrap Glyphicons.png"><a href="http://v3.bootcss.com/components/">bootstrap Glyphicons</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>阿里巴巴矢量图标库.png"><a href="http://www.iconfont.cn">阿里巴巴矢量图标库</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.thinkcmf.com/font">Font Awesome</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>lufylegend.png"><a href="http://lufylegend.com">lufylegend</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>lufylegend文档.png"><a href="http://lufylegend.com/api/zh_CN/out">lufylegend文档</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.css88.com/doc/zeptojs_api">Zepto.js文档</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>APICloud.png"><a href="http://www.apicloud.com">APICloud</a></div>
	</div>
</div>
<div id="yii" class='panel panel-default'>
	<div class='panel-heading'><strong>Yii & laravel</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="https://luluqi.cn">luluyii</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Yii 中文社区.png"><a href="http://www.yiichina.com">Yii 中文社区</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>kartik-v扩展.png"><a href="http://demos.krajee.com">kartik-v扩展</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>白狼栈博客.png"><a href="http://www.manks.top">白狼栈博客</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>深入理解Yii2.0.png"><a href="http://www.digpage.com">深入理解Yii2.0</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Yii 中文网.png"><a href="http://www.yii-china.com">Yii 中文网</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>Get√Yii.png"><a href="http://www.getyii.com">Get√Yii</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>猿书.png"><a href="http://www.51siyuan.cn">猿书</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.cnblogs.com/vishun/tag/Yii2">Yii2笔记</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Yii爱好者中文社区.png"><a href="http://www.yiifans.com">Yii爱好者中文社区</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>核果.png"><a href="https://www.heguo.org">核果</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.yiibai.com/yii2">Yii2教程</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>Laravist.png"><a href="https://laravist.com">Laravist</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Laravel学院.png"><a href="http://laravelacademy.org">Laravel学院</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>golaravel.png"><a href="http://www.golaravel.com">golaravel</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>easywechat.png"><a href="https://easywechat.org">easywechat</a></div>
	</div>
</div>
<div id="php" class='panel panel-default'>
	<div class='panel-heading'><strong>php</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>博客园.png"><a href="http://www.cnblogs.com">博客园</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>php.png"><a href="http://php.net/manual/zh">php</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>菜鸟教程.png"><a href="http://www.runoob.com">菜鸟教程</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>极客学院.png"><a href="http://www.jikexueyuan.com">极客学院</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>慕课网.png"><a href="http://www.imooc.com">慕课网</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>开源中国.png"><a href="http://www.oschina.net">开源中国</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>龙天论坛.png"><a href="http://www.lthack.com">龙天论坛</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>CSDN.png"><a href="http://www.csdn.net">CSDN</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>脚本之家.png"><a href="http://www.jb51.net">脚本之家</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>看云.png"><a href="http://www.kancloud.cn/explore">看云</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>segmentfault.png"><a href="https://segmentfault.com">segmentfault</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>W3C.png"><a href="http://www.w3school.com.cn">W3C</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>沈逸.png"><a href="http://www.hishenyi.com">沈逸</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.bo56.com">信海龙</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>廖雪峰.png"><a href="http://www.liaoxuefeng.com">廖雪峰</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>刘未鹏.png"><a href="http://mindhacks.cn">刘未鹏</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>鳥哥的 Linux 私房菜.png"><a href="http://linux.vbird.org">鳥哥的 Linux 私房菜</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>树洞外链.png"><a href="https://yun.aoaoao.me">树洞外链</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>阿风博客.png"><a href="https://www.feng97.com">阿风博客</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>emlog个人博客系统.png"><a href="http://www.emlog.net">emlog个人博客系统 </a></div>
	</div>
</div>
<div id="download" class='panel panel-default'>
	<div class='panel-heading'><strong>下载</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>系统之家.png"><a href="http://www.xitongzhijia.net">系统之家</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>ZOL软件下载.png"><a href="http://xiazai.zol.com.cn">ZOL软件下载</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>华军软件园.png"><a href="http://www.onlinedown.net">华军软件园</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>游民星空.png"><a href="http://www.gamersky.com">游民星空</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>游侠网.png"><a href="http://www.ali213.net">游侠网</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>电影天堂.png"><a href="http://www.dytt8.net">电影天堂</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>RARBT.png"><a href="http://www.rarbt.com">RARBT</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>硕鼠.png"><a href="http://www.flvcd.com">硕鼠</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>资源共享.png"><a href="http://www.ed2000.com">资源共享</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>XICXI.png"><a href="http://www.xicxi.com">XICXI</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://lyplayer.hkjapp.com">灵音播放器</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>动漫花园.png"><a href="http://share.dmhy.org">动漫花园</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>天使动漫论坛.png"><a href="http://www.tsdm.net">天使动漫论坛</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度网盘.png"><a href="http://pan.baidu.com">百度网盘</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度网盘.png"><a href="http://www.baiduyunwangpan.com">百度网盘下载</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度网盘.png"><a href="http://www.wangpansou.cn">百度网盘搜</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度网盘.png"><a href="http://pan.open1111.com">百度网盘搜索</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>酷安.png"><a href="http://www.coolapk.com">酷安</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.iidvd.com">iiDVD影院</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>BT海盗湾中文网.png"><a href="http://hdbt8.com">BT海盗湾中文网</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>射手网(伪).png"><a href="http://assrt.net">射手网(伪)</a></div>
	</div>
</div>
<div id="other" class='panel panel-default'>
	<div class='panel-heading'><strong>视频 & 番茄</strong></div>
	<div class='panel-body'>
		<div class="col-md-2"><img lay-src="<?=$path?>直播吧.png"><a href="http://www.zhibo8.cc">直播吧</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>英超直播吧.png"><a href="http://www.yczbb.com">英超直播吧</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>无插件网.png"><a href="http://www.5chajian.com">无插件网</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>新英体育.png"><a href="http://www.ssports.com">新英体育</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>乐视体育.png"><a href="http://www.lesports.com">乐视体育</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://www.jczqw.com">江城足球</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>萝莉云.png"><a href="http://loli.cskin.net">萝莉云</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>优酷.png"><a href="http://www.youku.com">优酷</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>腾讯视频.png"><a href="http://v.qq.com">腾讯视频</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>风科学上网.png"><a href="http://www.feng666.cc">feng666</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>GREEN VPN.png"><a href="http://jsq.re">GREEN VPN</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>LoCoJSQ.png"><a href="https://www.locovpn.com">LoCoJSQ</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>Facebook.png"><a href="https://www.facebook.com">Facebook</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>YouTube.png"><a href="https://www.youtube.com">YouTube</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>savefrom.png"><a href="http://en.savefrom.net">savefrom</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>Twitter.png"><a href="https://twitter.com">Twitter</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>谷歌.png"><a href="https://www.google.com">谷歌</a></div>
        <div class="col-md-2"><img lay-src="<?=$path?>JRS直播.png"><a href="http://www.jrstv.cc">JRS直播</a></div><br /><br />
	</div>
</div>
<div id="other" class='panel panel-default'>
	<div class='panel-heading'><strong>other</strong></div>
	<div class='panel-body'>
		
		<div class="col-md-2"><img lay-src="<?=$path?>淘宝.png"><a href="http://www.taobao.com">淘宝</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>京东.png"><a href="https://www.jd.com">京东</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>ZEALER FIX.png"><a href="http://fix.zealer.com">ZEALER FIX</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>QQ.png"><a href="https://mail.qq.com">QQ邮箱</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>gmail.png"><a href="https://mail.google.com">gmail</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>网易.png"><a href="http://mail.126.com">126邮箱</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>知乎.png"><a href="https://www.zhihu.com">知乎</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>新浪微博.png"><a href="http://www.weibo.com">新浪微博</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>天涯社区.png"><a href="http://www.tianya.cn">天涯社区</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>知页.png"><a href="http://www.zhiyeapp.com">知页</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>汕头招聘网.png"><a href="http://www.stzp.cn">汕头招聘网</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>百度.png"><a href="https://www.baidu.com">百度</a></div><br /><br />
		<div class="col-md-2"><img lay-src="<?=$path?>微信公众平台.png"><a href="https://mp.weixin.qq.com">微信公众平台</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>范垂恒.png"><a href="http://www.kilakila.cn">范垂恒</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>默认.png"><a href="http://139.129.18.185:8080/epowercms">松湖控股公租房</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>QQ.png"><a href="https://ic.qq.com">QQ同步助手</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>豆瓣电影.png"><a href="https://movie.douban.com">豆瓣电影</a></div>
		<div class="col-md-2"><img lay-src="<?=$path?>teamViewer.png"><a href="https://www.teamviewer.com">teamViewer</a></div>
	</div>
</div>
<?php $this->beginBlock('coolSiteJS')?>
	layui.use('flow', function(){
  		var flow = layui.flow;
      	flow.lazyimg(); 
    });
<?php $this->endBlock()?>
<?php $this->registerJS($this->blocks['coolSiteJS'],\yii\web\View::POS_END)?>