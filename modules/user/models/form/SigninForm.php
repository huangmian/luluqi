<?php
namespace modules\user\models\form;

use Yii;
use modules\user\models\UserInfo;
use yii\base\Model;

class SigninForm extends Model
{
    public static function isNotSignin()
    {
        if(\Yii::$app->user->isGuest){
            return true;
        }
        $userInfo = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
        $todayZeroTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
        if ($userInfo->signin_time<$todayZeroTime){
            return true;
        }
        return false;
    }
    
    //签到会员人数
    public static function siginNum()
    {
        $todayZeroTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
        return UserInfo::find()->where(['>','signin_time',$todayZeroTime])->count();
    }
    
    //签到的全部会员
    public function siginMembers()
    {
        $todayZeroTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
        return UserInfo::find()->where(['>','signin_time',$todayZeroTime])->orderBy(['signin_day'=>SORT_DESC])->all();
    }
    
    //个人连续签到天数
    public static function siginDay()
    {
        return UserInfo::findOne(['user_id'=>Yii::$app->user->id])->signin_day;
    }
}