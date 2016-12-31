<?php
namespace modules\user\models;

use modules\user\models\User;
use yii\db\ActiveRecord;

class UserFans extends ActiveRecord
{
    public static function exitFocus($focus_who)
    {
        $from = \Yii::$app->user->identity->username;
        return UserFans::findOne(['from' => $from,'to' => $focus_who]);
    }
    
    public function focus($focus_who)
    {
        $from = \Yii::$app->user->identity->username;
        $user_fans = new UserFans();
        if(!$this->exitFocus($focus_who)){
            $user_fans->from = $from;
            $user_fans->to = $focus_who;
            $user_fans->focus_time = time();
            return $user_fans->save();
        }
        return null;
    }
    
    public function getFromUser()
    {
        return User::find()->where(['username'=>$this->from])->one();
    }
    
    public function getToUser()
    {
        return User::find()->where(['username'=>$this->to])->one();
    }
}