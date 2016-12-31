<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use kartik\icons\Icon;
use modules\post\models\PostType;
Icon::map($this);
NavBar::begin([
    'brandLabel' => Yii::$app->params['siteName'],
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
foreach (PostType::find()->where(['parent_id'=>0])->all() as $key=>$val){
    $label[$val->type_id] = ['label' => $val->name,'url' => ['/post/default/show-posts','type_id'=>$val->type_id]];
}
echo Nav::widget([
    'options' => ['class' => 'nav navbar-nav '],
    'items' => [
        $label[1],$label[2],//需优化
        ['label' => "关于我",'url' => ['/site/diary']],
    ],
    'encodeLabels' => false]);
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => Yii::t('user', 'Signup'), 'url' => ['/user/default/signup']];
    $menuItems[] = ['label' => Yii::t('user', 'Login'), 'url' => ['/user/default/login']];
} else {
    $user = Yii::$app->user->identity;
    $notice = $user->userNotice;
    $noticeCount = $user->userNoticeCount;
    $items = [];
    for ($i=0;$i<$noticeCount;$i++){
        if (empty($items) || $notice[$i]->type !== $notice[$i-1]->type){
            $items[] = ['label' => $notice[$i]->noticesZh,'url' => ['/user/notice','type'=>$notice[$i]->type]];
        }
    }
    $menuItems[] = [
        'label' => Html::tag('i', '', ['class' => 'glyphicon glyphicon-bell']).Html::tag('span', $noticeCount ? $noticeCount : null,['class'=>$noticeCount ? 'badge' : null]),
        'url' => $items?['#']:['/user/notice'],
        'items' => $items,
    ];
    $label = [];
    if (in_array($user->username, Yii::$app->params['adminName'])){
        $label = ['label' => '<span class="glyphicon glyphicon-remove"></span> '.Yii::t('common', 'Back Manager'),'url' => ['/user/user/index']];
    }else{
        $label = ['label'=>''];
    }
    $menuItems[] = [
        'label' => $user->showImage(['width'=>20,'height'=>20],'img-rounded'),
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-home"></span> 个人中心','url' => ['/user/default/modify-info']],
            $label,
            '<li class="divider"></li>',
            ['label' => '<span class="glyphicon glyphicon-log-out"></span> 退出登录',
            'url' => ['/user/default/logout'],'linkOptions' => ['data-method' => 'post']],
        ],
    ];
}
echo Nav::widget([
    'options' => ['class' => 'nav navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => $menuItems,
    'activateParents' => true,
]);
$search =
    '<form class="navbar-form navbar-right" action="/post/default/search-post">
        <div class="input-group">
            <input type="search" name="title" value="" class="form-control" placeholder="搜索文章"><a class="clear"></a>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
             </span>
        </div>
    </form>';
echo $search;
NavBar::end();
?>
<?php $this->beginBlock('index')?>
 .form-control {
    height: auto;
}
<?php $this->endBlock()?>
<?php $this->registerCss($this->blocks['index'])?>