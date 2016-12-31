<?php
namespace modules\user\models\form;

use Yii;
use modules\user\models\UserNotice;
use yii\base\Model;
use modules\user\models\UserMessage;

class SendMessageForm extends Model
{
    public $username;
    public $message;
    private $_user = false;

    public function rules()
    {
        return [
            [['username','message'],'required'],
            ['username','string','min'=>2,'max'=>12],
            ['message','string','max'=>2550],
            ['username','exist','targetClass' => 'modules\user\models\User','message' => '用户不存在']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=> '收信人',
            'message'=> '信息内容',
        ];
    }

    public function sendMessage()
    {
        if ($this->validate()){
            if ($this->username == $this->getUser()->username){
                return $this->addError('username','不能发给自己');    
            }
            $user_message = new UserMessage();
            $user_message->from = $this->getUser()->username;
            $user_message->to = $this->username;
            $user_message->content = $this->message;
            $user_message->send_time = time();
            $user_message->save();
            return UserNotice::setNotice(Yii::$app->user->id,$user_message->toUser->id,'message');
        }
        return null;
    }
    
    public function getUser()
    {
        if($this->_user===false){
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }
}