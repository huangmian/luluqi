<?php
use yii\helpers\Html;
//生成链接的字符串形式，并传递$token过去
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password','token'=>$user->password_reset_token]);
?>
你好 <?= Html::encode($user->username) ?>，
请于<?php echo date('Y-m-d G:i:s', time()+Yii::$app->params['user.passwordResetTokenExpire']);?>前点击下面的链接重置您的密码：<br/>
<?= Html::a(Html::encode($resetLink), $resetLink) ?>