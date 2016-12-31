<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
use modules\user\models\UserInfo;
Icon::map($this);
NavBar::begin([
    'brandLabel' => Yii::$app->params['siteName'],
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'nav navbar-nav '],
    'items' => [
        ['label' => '<span class="glyphicon glyphicon-user"></span> '.Yii::t('user', 'User').Yii::t('common', 'Manager'),
            'items' => [
                ['label' => Yii::t('user', 'User').Yii::t('common', 'Manager'),'url' => ['/user/user/index']],
                ['label' => Yii::t('user', 'UserInfo').Yii::t('common', 'Manager'),'url' => ['/user/user-info/index']],
            ],
        ],
        ['label' => '<span class="glyphicon  glyphicon-book"></span> '.Yii::t('post', 'Post').Yii::t('common', 'Manager'),
            'items' => [
                ['label' => Yii::t('post', 'Post').Yii::t('common', 'Manager'),'url' => ['/post/post/index']],
                ['label' => Yii::t('post', 'Comment').Yii::t('common', 'Manager'),'url' => ['/post/post-comment/index']],
                ['label' => Yii::t('post', 'Post Types').Yii::t('common', 'Manager'),'url' => ['/post/post-type/index']],
                ['label' => Yii::t('post', 'Post Tags').Yii::t('common', 'Manager'),'url' => ['/post/post-tag/index']],
            ],
        ],
        ['label' => '<span class="glyphicon glyphicon-eye-open"></span> '.Yii::t('user', 'Visit').Yii::t('common', 'Manager'),
            'items' => [
                ['label' => Yii::t('user', 'AllVisit').Yii::t('common', 'Manager'),'url' => ['/user/visit/index']],
                ['label' => Yii::t('user', 'VisitDay').Yii::t('common', 'Manager'),'url' => ['/user/visit-day/index']],
                ['label' => Yii::t('user', 'VisitCount').Yii::t('common', 'Manager'),'url' => ['/user/visit-count/index']],
            ],
        ],
    ],
    'encodeLabels' => false]);
    $user = Yii::$app->user->identity;
    $userInfo = UserInfo::findOne(['user_id' => $user->id]);
    $menuItems = [
        ['label' => '<span class="glyphicon glyphicon-edit"></span>'.Yii::t('user', 'Mass Message'),'url' => ['/user/mass-message']],
        ['label' => '<span class="glyphicon glyphicon-remove"></span> 调试',
            'items' => [
                ['label' => 'gii','url' => ['/gii']],
                ['label' => 'debug','url' => ['/debug']],
            ],
        ],
        ['label' => $user->showImage(['width'=>20,'height'=>20],'img-rounded'),
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-home"></span> 个人中心','url' => ['/user/default/modify-info']],
                ['label' => '<span class="glyphicon glyphicon-remove"></span> '.Yii::t('common', 'Back Manager'),'url' => ['/user/user']],
                '<li class="divider"></li>',
                ['label' => '<span class="glyphicon glyphicon-log-out"></span> 退出登录',
                    'url' => ['/user/default/logout'],'linkOptions' => ['data-method' => 'post']],
            ],
        ],
    ];
echo Nav::widget([
    'options' => ['class' => 'nav navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => $menuItems,
]);
NavBar::end();