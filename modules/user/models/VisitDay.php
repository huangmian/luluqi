<?php
namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;

class VisitDay extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_visit_day}}';
    }

    public function rules()
    {
        return [
            [['visit_ip', 'visit_time'], 'required'],
            [['visit_time'], 'integer'],
            [['visit_ip'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'visit_ip' => Yii::t('user', 'Visit Ip'),
            'visit_time' => Yii::t('user', 'Visit Time'),
        ];
    }
    
    public static function ExitVisit()
    {
        $visit_ip = Yii::$app->request->userIP;
        $visit = self::findOne(['visit_ip' => $visit_ip]);
        if ($visit){
            $visit->visit_time = time();
            return $visit->save();
        }else{
            $visit = new VisitDay();
            $visit->visit_ip = $visit_ip;
            $visit->visit_time = time();
            return $visit->save();
        }
        return true;
    }
    
    public static function visitNum()
    {
        return Yii::$app->controller->id=='site'?VisitDay::find()->count():true;
    }
    
    public static function OnlineNum()
    {
        //如果用户半个小时之内访问过，则表示用户在线
        return self::find()->where(['>','visit_time',time()-60*30])->count();
    }
}