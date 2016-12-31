<?php
namespace modules\user\models\form;

use Yii;
use yii\web\ForbiddenHttpException;
use yii\base\Model;
use modules\user\models\User;
use modules\user\models\UserInfo;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    public $verifyCode;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            //汉字的unicode范围是：0x4E00~0x9FA5，其实这个范围还包括了中，日，韩的字符
            //  u 表示按unicode(utf-8)匹配（主要针对多字节比如汉字）
            //  \x忽略空白
            //[(\x{4E00}-\x{9FA5})a-zA-Z]+表示以汉字或者字母开头，出现1-n次
            //[(\x{4E00}-\x{9FA5})\w]*表示以汉字字母数字下划线组成，出现0-n次
            //^是开始符号  $是结尾符号        / /是界定符
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})\w]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],
            ['username', 'unique', 'targetClass' => 'modules\user\models\User', 'message' => '用户名已经被注册过.'],
            ['username', 'string', 'min' => 2, 'max' => 12],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail'],
            ['email', 'unique', 'targetClass' => 'modules\user\models\User', 'message' => '邮箱已经被使用过.'],

            [['password','repassword'],'required'],
            [['password','repassword'], 'string', 'min' => 6],
            ['repassword','compare','compareAttribute'=>'password','message' => '两次输入的密码不一致'],
            //这里也需要添加captchaAction进行验证码的验证
            //但是开启ajax验证的时候需要关闭，不知道为什么？初步解释是进行了两次验证，第一次是ajax验证，第二次是客户端提交的时候去全部
            //验证每次验证的时候验证码刷新导致不正确，是否可以经过ajxa验证之后不再需要进行验证呢？
            //而用户名、邮箱、密码那些是不会变的，所以不会报错
            //['verifyCode', 'captcha','captchaAction'=>'/user/default/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return
        [
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'repassword' => Yii::t('user', 'RePassword'),
            'email' => Yii::t('user', 'Email'),
            'verifyCode'=> Yii::t('user', 'VerifyCode'),
        ];
    }
    
    //这里的邮箱验证仅仅是checkdnsrr()验证邮箱的域名是否存在，但是貌似yii2自带的emailValidate已经验证了，可是验证不了的？
    public function validateEmail($attribute, $params)
    {
        if (!checkdnsrr(substr($this->email, strrpos($this->email, '@') + 1))){
            $this->addError('email', '邮箱不是有效的邮箱地址');
        }
    }
    
    public function init()
    {
        parent::init();
        Yii::$app->set('mailer', [
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

    public function signup()
    {
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'email' => $this->email,
                'registration_ip' => Yii::$app->request->userIP,
            ]);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            //通过生成token进行邮箱的验证
            if(!$user->isPasswordResetTokenValid($user->password_reset_token)){
                $user->generatePasswordResetToken();
            }
            $sendEmailSuccess = yii::$app->mailer->compose('ActivateAccountToken',['user'=>$user])
                 ->setFrom([yii::$app->params['smtpUser'] => Yii::$app->params['siteName']])
                 ->setTo($this->email)
                 ->setSubject(Yii::$app->params['siteName'].'激活账号')
                 ->send();
            //当发送邮件成功时才进行保存用户
            if($sendEmailSuccess){
                 return $user->save(false);
             }else{
                 $this->addError('email','请提供有效的邮箱地址');
             }
        }
        return null;
    }

    public function removeToken($user)
    {
        if(empty($user)){
           throw new ForbiddenHttpException('激活账号的令牌不能为空，请到邮箱再次点击链接激活您的账号');
        }
        if (!User::isPasswordResetTokenValid($user->password_reset_token)){
            return NULL;
            //throw new ForbiddenHttpException('激活账号的令牌已经失效，请通过重新找回密码的方式重新发送邮件');
        }
        if(!$user){
            throw new ForbiddenHttpException('您的账号已经激活，请到登陆页面进行登陆');
        }
        $user->removePasswordResetToken();
        //注册的时候status字段默认为0，现在把它设置为10，即激活状态
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        //保存用户的个人信息
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        return  $userInfo->save();
    }
}