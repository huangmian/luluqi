<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$db = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/db-local.php')
    );
$config = [
    'language' => 'zh-CN',
    'timeZone' => 'PRC',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    /* 'catchAll'=>[
        'offline',
        'param1'=>'升级',
        'param2'=>'维护',
    ], */
    'bootstrap' => ['log','devicedetect'],
    'components' => [
        'devicedetect' => [
            'class' => 'lulubin\devicedetect\DeviceDetect'
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'weixin',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],
        'user' => [
            'identityClass' => 'modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',//保存日志消息到文件中
                    'levels' => ['error', 'warning'],//指定记录信息的等级
                    'logFile' => '@runtime/logs/output.log',//向哪个文件输出信息
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views'=>'@themes/basic',
                    '@modules/user/views'=>'@themes/modules/user',
                    '@modules/post/views'=>'@themes/modules/post',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@modules/user/messages',
                ],
                'post' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@modules/post/messages',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'qq' => [
                    'class' => 'lulubin\oauth\Qq',
                    'clientId' => '********',
                    'clientSecret' => '*******************************',
                ],
                'weibo' => [
                    'class' => 'lulubin\oauth\Weibo',
                    'clientId' => '**************',
                    'clientSecret' => '*****************************',
                ],
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => '***********',
                    'clientSecret' => '***************************',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,//用于URL路径化
            //'suffix'=>'.html',
            //指定是否在URL在保留入口脚本 index.php,同时apache还要在index.php同级目录下新建.htaccess文件
            'showScriptName' => false,
            'rules' => require(__DIR__.'/rules.php'),
        ],
        'db' => $db,
    ],
    'params' => $params,
    'modules' => require(__DIR__.'/modules.php'),
];
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1'],
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'myCrud' => '@app/components/giitemplate/crud/default',
                ]
            ]
        ],
    ];
}
return $config;