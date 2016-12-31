/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : luluqi

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-12-31 13:59:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lulu_post
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post`;
CREATE TABLE `lulu_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `is_visible` smallint(1) DEFAULT '1',
  `is_top` smallint(1) DEFAULT '0',
  `is_essence` smallint(1) DEFAULT '0',
  `is_reprint` smallint(1) DEFAULT '0',
  `up` int(11) DEFAULT '0',
  `down` int(11) DEFAULT '0',
  `comment_num` int(11) DEFAULT '0',
  `view_num` int(11) DEFAULT '0',
  `collection` int(11) DEFAULT '0',
  `content` mediumtext NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lulu_post_fk1` (`user_id`),
  CONSTRAINT `lulu_post_fk1` FOREIGN KEY (`user_id`) REFERENCES `lulu_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post
-- ----------------------------
INSERT INTO `lulu_post` VALUES ('1', '1', '3', '1', '基于yii2的小系统', '1', '0', '1', '0', '0', '0', '0', '0', '0', '<p>1、网站演示地址：<a href=\"http://www.luluqi.cn/\" target=\"_blank\">luluyii</a><br></p><p>2、项目简介：</p><p>（1）、项目基于yii2基础版</p><p>（2）、只有用户名为“admin”的用户才可以进入后台</p><p>（3）、admin的密码为123456（演示网站的密码不是这个，演示网站的源码放在bitbucket）</p><p>3、安装</p><p>（1）、直接运行 `git clone https://github.com/lulubin/luluyii.git` 克隆到工作目录，或者直接下载zip包</p><p>（2）、运行 `composer install --prefer-dist` 安装yii2核心文件</p><p>（3）、创建数据库 `luluyii` 编码 `utf8-unicode-ci`，执行 `config/luluyii.sql` 创建表格</p><p>（4）、网站的邮箱配置在config/parmas.php中，发送邮件请开启php_openssl扩展</p><p>注意：网站首页的统计访问人数用的是mysql定时任务，必须将事件计划开启: set global event_scheduler=1;</p>', '1465987142', '1483161890');
INSERT INTO `lulu_post` VALUES ('2', '1', '3', '1', 'QQ、微信、微博、Github第三方登录', '1', '0', '1', '0', '0', '0', '0', '0', '0', '<p><strong>1、安装 </strong><a href=\"https://github.com/lulubin/yii2-oauth\" target=\"_blank\"><strong>lulubin/yii2-oauth</strong></a></p><p>composer require --prefer-dist lulubin/yii2-oauth dev-master</p><p><strong>2、配\r\n\r\n置，在components中增加如下内容</strong></p><pre>\'components\' =&gt; [\r\n    \'authClientCollection\' =&gt; [\r\n        \'class\' =&gt; \'yii\\authclient\\Collection\',\r\n        \'clients\' =&gt; [\r\n            \'qq\' =&gt; [\r\n                \'class\' =&gt; \'lulubin\\oauth\\Qq\',\r\n                \'clientId\' =&gt; \'***\',\r\n                \'clientSecret\' =&gt; \'***\',\r\n            ],\r\n            \'weibo\' =&gt; [\r\n                \'class\' =&gt; \'lulubin\\oauth\\Weibo\',\r\n                \'clientId\' =&gt; \'***\',\r\n                \'clientSecret\' =&gt; \'***\',\r\n            ],\r\n            \'weixin\' =&gt; [\r\n                \'class\' =&gt; \'lulubin\\oauth\\Weixin\',\r\n                \'clientId\' =&gt; \'***\',\r\n                \'clientSecret\' =&gt; \'***\',\r\n            ],\r\n            \'github\' =&gt; [\r\n                \'class\' =&gt; \'yii\\authclient\\clients\\GitHub\',\r\n                \'clientId\' =&gt; \'***\',\r\n                \'clientSecret\' =&gt; \'***,\r\n            ],\r\n        ]\r\n    ]\r\n]</pre><p><strong>3、在登录操作的控制器下</strong></p><pre>class SiteController extends Controller\r\n{\r\n    public function actions()\r\n    {\r\n        return [\r\n            \'auth\' =&gt; [\r\n                \'class\' =&gt; \'yii\\authclient\\AuthAction\',\r\n                \'successCallback\' =&gt; [$this, \'successCallback\'],\r\n            ],\r\n        ];\r\n    }\r\n\r\n    public function successCallback($client)\r\n    {\r\n        $id = $client-&gt;getId();\r\n        $attributes = $client-&gt;getUserAttributes();\r\n        var_dump($id, $attributes);\r\n    }\r\n}</pre><p><strong>4、在登录界面添\r\n\r\n加以下代码</strong></p><pre>use yii\\helpers\\Html;\r\nuse lulubin\\oauth\\assets\\AuthChoiceAsset;\r\nAuthChoiceAsset::register($this);\r\n&lt;div class=\"form-group other-way\"&gt;\r\n    &lt;?=Html::a(\'\',[\'/site/auth\',\'authclient\'=&gt;\'qq\'],[\'class\'=&gt;\'qq\'])?&gt;\r\n    &lt;?=Html::a(\'\',[\'/site/auth\',\'authclient\'=&gt;\'weibo\'],[\'class\'=&gt;\'weibo\'])?&gt;\r\n    &lt;?=Html::a(\'\',[\'/site/auth\',\'authclient\'=&gt;\'weixin\'],[\'class\'=&gt;\'weixin\'])?&gt;\r\n    &lt;?=Html::a(\'\',[\'/site/auth\',\'authclient\'=&gt;\'github\'],[\'class\'=&gt;\'github\'])?&gt;\r\n&lt;/div&gt;</pre><p><img src=\"https://luluqi.cn/images/post/2016/07/08/authclient.png\" width=\"262\" height=\"233\"></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\"><strong>5、申请上述第三方的 APP ID</strong><span class=\"redactor-\r\n\r\ninvisible-space\" data-redactor-class=\"redactor-\r\n\r\ninvisible-space\"><strong>和 APP KEY</strong></span></span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">（1）QQ互联：<a href=\"http://connect.qq.com/\" target=\"_blank\">http://connect.qq.com/</a></span></span></span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">（2）微信开放 平台：<a href=\"https://open.weixin.qq.com/\" target=\"_blank\">https://open.weixin.qq.com/</a></span></span></span></p><p><span class=\"redactor-invisible-\r\n\r\nspace\" data-redactor-class=\"redactor-invisible-\r\n\r\nspace\"><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">（3）新浪微博开放平台：<a href=\"http://open.weibo.com/\" target=\"_blank\">http://open.weibo.com/</a></span></span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">（4）Github Developer applications<span class=\"redactor-invisible-space\">：<a href=\"https://github.com/settings/developers\" target=\"_blank\">https://github.com/settings/developers</a></span></span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">QQ和微博的申请比较麻烦，时间久网站 需要备案；</span></span><strong>Github的申请则十分迅速，建议先申请这个测试。</strong></p>', '1467943407', '1483163629');
INSERT INTO `lulu_post` VALUES ('3', '1', '3', '1', '创建和删除 yii 扩展', '1', '0', '1', '0', '0', '0', '0', '0', '0', '<p><strong>一、新建 hello-yii2 仓库</strong></p><p>1、首先在 github 上面新建一个仓库 hello-yii2</p><img src=\"https://luluqi.cn/images/post/2016/07/30/01.png\"><p>2、进入 cmd，这里我们切换至 D \r\n\r\n盘，下载刚刚创建的 hello-\r\n\r\nyii2</p><img src=\"https://luluqi.cn/images/post/2016/07/30/02.png\"><p><strong>二、修改、提交、发布 hello-yii2 仓库\r\n\r\n</strong></p><p>1、初始化 composer </p><p>方法①、用 cmd 进行初始化。切换到 hello-yii2 目录，初始化 composer</p><img src=\"https://luluqi.cn/images/post/2016/07/30/03.png\"><p><br><img src=\"https://luluqi.cn/images/post/2016/07/30/04.png\"></p><p>方法②、使用 gii/extension 进行初始化</p><img src=\"https://luluqi.cn/images/post/2016/07/30/12.png\"><p>注：将 gii 生成的文件覆盖到 \r\n\r\nhello-yii2 文件夹中</p><p>2、修改 composer.json 文件\r\n\r\n</p><img src=\"https://luluqi.cn/images/post/2016/07/30/05.png\"><p>3、在 hello-yii2 根目录新建 Hello.php</p><img src=\"https://luluqi.cn/images/post/2016/07/30/06.png\"><p>4、修改 hello-\r\n\r\nyii2/README.md 文件</p><img src=\"https://luluqi.cn/images/post/2016/07/30/07.png\"><p>5、提交上述修改的文件到 github 仓库</p><img src=\"https://luluqi.cn/images/post/2016/07/30/08.png\"><p>在 github 发布一个初始化版本</p><img src=\"https://luluqi.cn/images/post/2016/07/30/15.png\" style=\"width: 627px; height: 190px;\" width=\"627\" height=\"190\"><p>6、发布\r\n\r\n到 <a href=\"https://packagist.org/\" target=\"_blank\">packagist</a><a href=\"https://packagist.org/\"></a></p><p>Packagist 是 Composer 的默认的开发包仓库。你可以将自己的安装包提交到 packagist，将来你在自己的 VCS （源码管理软件，比如 Github）仓库中新建了 tag 或更新了代码，packagist 都会自动构建一个新的开发包。这就是 packagist 目前的运作方式，将来 packagist 将允许直接上传开发包。<br><a href=\"https://packagist.org/\"></a></p><p><span class=\"redactor-invisible-space\">任何在 packagist 上发\r\n\r\n布的包都可以直接被 Composer 使用。<span class=\"redactor-invisible-space\"><br></span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">① 注册账号\r\n\r\n</span></span></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">② 点击右上角的 Submit 按钮，之后输入你的 github \r\n\r\n仓库地址，点击 check 之后 submit</span></span></p><img src=\"https://luluqi.cn/images/post/2016/07/30/09.png\"><p>7、packagist 自动更新 github 代码</p><img src=\"https://luluqi.cn/images/post/2016/07/30/13.png\" width=\"558\" height=\"233\" style=\"width: 558px; height: 233px;\"><img src=\"https://luluqi.cn/images/post/2016/07/30/14.png\" width=\"460\" height=\"392\" style=\"width: 460px; height: 392px;\"><p><strong>三、测试</strong></p><p><span class=\"redactor-invisible-space\"><span class=\"redactor-invisible-space\">1、进入 cmd 切换到 yii 项目\r\n\r\n</span></span></p><pre>运行 composer require luluyii/hello-yii2:\"*\"</pre><img src=\"https://luluqi.cn/images/post/2016/07/30/10.png\"><p><strong>注：下载时候记得看看自己项目根目录的 \r\n\r\ncomposer.json 的 \"minimum-stability\": \"dev\"，是不是dev，若不是则要改</strong></p><p>2、进入视图页面，输入</p><pre><img>&lt;?= luluyii\\hello\\Hello::sayHello()?&gt;</pre><p>3、查看效果\r\n\r\n</p><img src=\"https://luluqi.cn/images/post/2016/07/30/11.png\"><p><strong>四、删除 yii 扩展：</strong></p>composer remove luluyii/hello-yii2', '1469848098', '1483163622');

-- ----------------------------
-- Table structure for lulu_post_collection
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post_collection`;
CREATE TABLE `lulu_post_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post_collection
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_post_comment
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post_comment`;
CREATE TABLE `lulu_post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `desc` varchar(255) NOT NULL,
  `up` smallint(4) DEFAULT '0',
  `down` smallint(4) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lulu_post_comment_fk1` (`post_id`),
  KEY `lulu_post_comment_fk2` (`user_id`),
  CONSTRAINT `lulu_post_comment_fk1` FOREIGN KEY (`post_id`) REFERENCES `lulu_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lulu_post_comment_fk2` FOREIGN KEY (`user_id`) REFERENCES `lulu_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post_comment
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post_tag`;
CREATE TABLE `lulu_post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post_tag
-- ----------------------------
INSERT INTO `lulu_post_tag` VALUES ('1', 'Yii', '1467813435', '1467813435');

-- ----------------------------
-- Table structure for lulu_post_type
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post_type`;
CREATE TABLE `lulu_post_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post_type
-- ----------------------------
INSERT INTO `lulu_post_type` VALUES ('1', '0', '文章', '1467166469');
INSERT INTO `lulu_post_type` VALUES ('2', '0', '分享', '1467360862');
INSERT INTO `lulu_post_type` VALUES ('3', '1', 'Yii', '1467360870');

-- ----------------------------
-- Table structure for lulu_post_vote
-- ----------------------------
DROP TABLE IF EXISTS `lulu_post_vote`;
CREATE TABLE `lulu_post_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '文章/评论的赞、踩',
  `action` varchar(20) DEFAULT NULL,
  `vote_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_post_vote
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user`;
CREATE TABLE `lulu_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lulu_user
-- ----------------------------
INSERT INTO `lulu_user` VALUES ('1', 'luluqi', '3Yzf9yDmAxcagfJgZnHqx9UmMvzMwBF4', '$2y$13$RY0hvZKi2qLtvU2zLvuzo.tulKX3Dxc7wnT0VdI.tkUQtdiWfSPa2', null, '452936616@qq.com', '10', '1467275197', '1483163606', '14.216.9.212');

-- ----------------------------
-- Table structure for lulu_user_auth
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_auth`;
CREATE TABLE `lulu_user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_auth
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_fans
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_fans`;
CREATE TABLE `lulu_user_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(12) NOT NULL,
  `to` varchar(12) NOT NULL,
  `focus_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_fans
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_info
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_info`;
CREATE TABLE `lulu_user_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'userImage/defaultImage.jpg',
  `sex` tinyint(1) unsigned DEFAULT NULL COMMENT '0=男，1=女，2=保密',
  `qq` int(11) unsigned DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `signin_time` int(11) unsigned NOT NULL,
  `signin_day` int(11) unsigned DEFAULT NULL,
  `signature` varchar(255) NOT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_info
-- ----------------------------
INSERT INTO `lulu_user_info` VALUES ('1', '1', 'userImage/defaultImage.jpg', '0', '452936616', '1992年10月02日', '汕头', '0', '0', '0', 'Go on！', '1483163824');

-- ----------------------------
-- Table structure for lulu_user_message
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_message`;
CREATE TABLE `lulu_user_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `from` varchar(12) NOT NULL,
  `to` varchar(12) NOT NULL,
  `content` text NOT NULL,
  `send_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_message
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_message_system
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_message_system`;
CREATE TABLE `lulu_user_message_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_message_system
-- ----------------------------
INSERT INTO `lulu_user_message_system` VALUES ('1', '1', '欢迎来到luluyii，这是lulubin开发的cms，如有问题，请及时联系452936616@qq.com，谢谢。', '1467599471');

-- ----------------------------
-- Table structure for lulu_user_notice
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_notice`;
CREATE TABLE `lulu_user_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `is_read` tinyint(2) DEFAULT '0',
  `created_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lulu_user_notice_fk1` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_notice
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_visit
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_visit`;
CREATE TABLE `lulu_user_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_ip` varchar(255) NOT NULL,
  `visit_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_visit
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_visit_count
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_visit_count`;
CREATE TABLE `lulu_user_visit_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nums` int(11) NOT NULL,
  `created_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_visit_count
-- ----------------------------

-- ----------------------------
-- Table structure for lulu_user_visit_day
-- ----------------------------
DROP TABLE IF EXISTS `lulu_user_visit_day`;
CREATE TABLE `lulu_user_visit_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_ip` varchar(255) NOT NULL,
  `visit_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lulu_user_visit_day
-- ----------------------------

-- ----------------------------
-- Procedure structure for saveVistNum
-- ----------------------------
DROP PROCEDURE IF EXISTS `saveVistNum`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `saveVistNum`()
BEGIN
	INSERT INTO lulu_user_visit_count (nums,created_time) VALUES((SELECT COUNT(id) from lulu_user_visit_day),(select date_sub(curdate(),interval 1 day)));
	DELETE FROM lulu_user_visit_day;
	ALTER TABLE lulu_user_visit_day AUTO_INCREMENT =1;#Routine body goes here...
END
;;
DELIMITER ;

-- ----------------------------
-- Event structure for saveVistNum
-- ----------------------------
DROP EVENT IF EXISTS `saveVistNum`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `saveVistNum` ON SCHEDULE EVERY 1 DAY STARTS '2016-07-05 00:00:00' ON COMPLETION PRESERVE ENABLE DO CALL saveVistNum()
;;
DELIMITER ;
