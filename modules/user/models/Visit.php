<?php
namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;

class Visit extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_visit}}';
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
        if (!self::findOne(['visit_ip' => $visit_ip])){
            $visit = new Visit();
            $visit->visit_ip = $visit_ip;
            $visit->visit_time = time();
            return $visit->save();
        }
        return true;
    }
    
    public static function visitNum()
    {
        return Yii::$app->controller->id=='site'?Visit::find()->count():true;
    }
}