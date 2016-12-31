<?php
use yii\helpers\Html;
//生成链接的字符串形式，并传递$token过去
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/activate-account','token'=>$user->password_reset_token]);
?>
您的账户已经创建， 为了完成验证邮件请点击下面链接：
<?= Html::a(Html::encode($resetLink), $resetLink) ?>
<br/>
如果您不能点击这个链接，可以尝试复制此链接到浏览器地址栏。
如果不是您发送的请求，请忽略。