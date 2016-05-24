<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use modules\user\models\UserInfo;
use modules\user\models\User;
$user = User::getUser();
$userInfo = UserInfo::findOne(['user_id' => $user->id]);
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <h3 class='panel-title'><?= UserInfo::showImage($userInfo)?>  <strong><?=Html::encode($user->username)?></strong></h3>
    </div>
    <div class='panel-body'>
        <?=Menu::widget([
            /* 胶囊行导航 nav nav-pills */
            /* 垂直堆叠的导航 nav nav-pills nav-stacked*/
            'options' => ['class'=>'nav nav-pills nav-stacked'],
            'items' => [
                ['label' => '个人资料','url'=>'/user/default/modify-info'],
                ['label' => '积分、关注、粉丝','url'=>'/user/default/show-score'],
                ['label' => '更换头像','url'=>'/user/default/modify-image'],
                ['label' => '修改密码','url'=>'/user/default/modify-password'],
                ['label' => '我的私信','url'=>'/user/default/notice-message'],
                ['label' => '我的收藏','url'=>'/post/default/my-collect'],
                ['label' => '我的发布','url'=>'/post/default/my-post'],
            ],
        ])?>
    </div>
</div>