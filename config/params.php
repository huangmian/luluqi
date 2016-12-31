<?php
return [
    'adminName' => ['luluqi'],
    'adminEmail' => '452936616@qq.com',
    'smtpHost' => 'smtp.qq.com',//发送邮件请开启php_openssl扩展
    'smtpUser' => '452936616@qq.com',
    'smtpPassword' => '************',
    'smtpPort' => '587',
    'user.passwordResetTokenExpire' => 3600,
    'siteName' => 'luluqi',
    'pageSize' => ['less'=>'6','many'=>'10'],
    'icon-framework' => 'fa',
    'defaultUserImage' => 'userImage/defaultImage.jpg',
    'siteDomain' => 'http://www.luluqi.com',
    'imageDomain' => 'http://www.luluqi.com/images',
    'comment' => true,
    'luluyiiGlobal' => [
        'status' => ['10'=>'已激活','0'=>'未激活'],
        'sex' => ['0'=>'男','1'=>'女','2'=>'保密'],
        'is_visible' => ['0'=>'不可见','1'=>'可见'],
        'is_top' => ['0'=>'不置顶','1'=>'置顶'],
        'is_essence' => ['0'=>'非精华','1'=>'精华'],
        'is_reprint' => ['0'=>'原创','1'=>'转载'],
    ],
];