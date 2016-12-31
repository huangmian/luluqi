# Yii2开发的小系统 #


### 安装 ###

1、网站演示地址：luluqi

2、项目简介：

（1）、项目基于yii2基础版

（2）、只有用户名为“luluqi”的用户才可以进入后台

（3）、luluqi的密码为123456（演示网站的密码不是这个，演示网站的源码放在bitbucket）

3、安装

（1）、下载代码

直接运行 `git clone https://github.com/lulubin/luluyii.git` 克隆到工作目录，或者直接下载zip包

然后，运行 `composer install --prefer-dist` 安装yii2核心文件

注：上面的步骤可以换成直接下载百度云压缩包，密码

（2）、创建数据库 `luluqi`

编码 `utf8-unicode-ci`，执行 `config/luluqi.sql` 创建表格，

然后，修改 config/db.php 文件中数据库的密码为你本地数据库密码

（3）配置本地站点域名：www.luluqi.com

① nginx：打开 nginx/conf/vhosts.conf，在文件的末尾追加以下代码

注意：root 为 luluqi/web 所在文件路径
```
server {
        listen       80;
        server_name  www.luluqi.com ;
        root   "D:/Program Files/phpStudy/WWW/luluqi/web";
        location / {
            index  index.html index.htm index.php;
            if (!-e $request_filename){  
              rewrite ^/(.*) /index.php last;  
            }  
        }
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}
```
② apache：打开 apache/conf/vhosts.conf，在文件的末尾追加以下代码

注意：DocumentRoot 为 luluqi/web 所在文件路径
```
<VirtualHost *:80>
    DocumentRoot "D:\Program Files\phpStudy\WWW\luluqi\web"
    ServerName www.luluqi.com
    ServerAlias 
  <Directory>
      Options FollowSymLinks ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
      Require all granted
  </Directory>
</VirtualHost>
```
（4）、配置 hosts 文件

打开 hosts 文件，添加一下代码：
```
127.0.0.1 www.luluqi.com
```

访问 www.luluqi.com

（5）、注意事项

①、网站的邮箱配置在 config/parmas.php 中，发送邮件请开启php_openssl扩展

②、网站首页的统计访问人数用的是 mysql 定时任务，必须将事件计划开启: set global event_scheduler=1;

③、关于第三方登录需要申请 clientId、clientSecret，其配置文件为 config/web.php
