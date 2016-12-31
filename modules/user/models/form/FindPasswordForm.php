<?php
namespace modules\user\models\form;

use Yii;
use yii\base\Model;
use modules\user\models\User;

class FindPasswordForm extends Model
{
    public $email;

    public function init()
    {
        parent::init();
        \Yii::$app->set('mailer', [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => yii::$app->params['smtpHost'],
                'username' => yii::$app->params['smtpUser'],
                'password' => yii::$app->params['smtpPassword'],
                'port' => yii::$app->params['smtpPort'],
                'encryption' => 'tls',
        ]]);
    }

    public function rules()
    {
        return [
            ['email','filter','filter'=>'trim'],
            ['email','required'],
            ['email','email'],
            //检测用户输入的邮箱是否存在于数据库
            //用户是服务器验证，需要在控制器中添加$model->validate()进行服务器验证
            //当然，如果在客户端先验证了，最好也在服务器端再一次进行验证
            ['email','exist','targetClass' => 'modules\user\models\User','message' => '用户不存在',],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'=> Yii::t('user', 'Email'),
        ];
    }

    public function sendEmail()
    {
        if ($this->validate()){
            $user = User::findOne(['email'=>$this->email]);
            if($user){
                //如果重置密码的令牌过期了，就重新生成令牌；一开始令牌为空，是过期的，所以一开始会生成令牌
                if(!User::isPasswordResetTokenValid($user->password_reset_token)){
                    $user->generatePasswordResetToken();
                }
                if($user->save()){
                    return  Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                    ->setFrom([yii::$app->params['smtpUser'] => Yii::$app->params['siteName']])
                    ->setTo($this->email)
                    ->setSubject(Yii::$app->params['siteName'].'重置密码 ' )
                    ->send();
                }
            }
        }
        return false;
    }
}