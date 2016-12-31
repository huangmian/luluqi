<?php
namespace modules\user\models\form;

use Yii;
use modules\user\models\User;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use modules\user\models\UserInfo;

class ResetPasswordForm extends Model
{
    public $new_password;
    public $renew_password;
    private $_user;

    //$token是用户点击链接时传递过来的
    public function __construct($token)
    {
        if(empty($token) || !is_string($token)){
            throw new NotFoundHttpException('激活账号的令牌不能为空，请到邮箱再次点击链接重置您的密码');
        }
        //通过token获取当前用户的所有数据
        $this->_user = User::findByPasswordResetToken($token);
        if(!$this->_user){
            throw new NotFoundHttpException('重置密码的邮件已经过期，请重新找回密码');
        }
    }

    public function rules()
    {
        return [
            [['new_password','renew_password'],'required'],
            [['new_password','renew_password'],'string','min'=>6],
            ['renew_password','compare','compareAttribute'=>'new_password','message'=>'两次输入的密码不一致']
        ];
    }

    public function attributeLabels()
    {
        return [
            'new_password'=> Yii::t('user', 'New Password'),
            'renew_password'=> Yii::t('user', 'Renew Password'),
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        if($this->validate()){
            $user->setPassword($this->new_password);
            $user->removePasswordResetToken();
            $user->status = 10;
            $user->save();
            if (!UserInfo::findOne(['user_id'=>$user->id])){
                $userInfo = new UserInfo();
                $userInfo->user_id = $user->id;
                return  $userInfo->save();
            }
            return true;
        }
    }
}