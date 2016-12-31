<?php
namespace modules\user\models\form;

use Yii;
use yii\base\Model;

class ModifyPasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $renew_password;
    private $_user = false;

    public function rules()
    {
        return [
            [['old_password','new_password','renew_password'],'required'],
            [['new_password','renew_password'],'string','min'=>6],
            ['renew_password','compare','compareAttribute'=>'new_password','message'=>'两次输入的密码不一致'],
            ['old_password','validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password'=> Yii::t('user', 'Old Password'),
            'new_password'=> Yii::t('user', 'New Password'),
            'renew_password'=> Yii::t('user', 'Renew Password'),
        ];
    }

    public function validatePassword($attribute,$param)
    {
        if(!$this->hasErrors()){
            $user = $this->getUser();
        }
        if(!$user || !$user->validatePassword($this->old_password)){
            $this->addError('old_password','密码错误');
        }
    }

    public function modifyPassword()
    {
        if ($this->validate()){
            $user = $this->getUser();
            $user->setPassword($this->new_password);
            return $user->save();
        }
    }

    public function getUser()
    {
        if($this->_user===false){
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }
}