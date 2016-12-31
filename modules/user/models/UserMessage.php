<?php
namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;

class UserMessage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_message}}';
    }
    
    public function rules()
    {
        return [
            [['from','to','content','send_time'],'required'],
            [['from','to'],'string','min'=>2,'max'=>12],
            ['content','string','max'=>255],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'from' => Yii::t('user', 'From'),
            'to' => Yii::t('user', 'To'),
            'content' => Yii::t('user', 'Content'),
            'send_time' => Yii::t('user', 'Created Time'),
        ];
    }
    
    //获取所有子私信个数
    public function getSonsNum()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id'])->count();
    }
    
    //获取所有子私信
    public function getSons()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }
    
    public function getToUser()
    {
        return User::findOne(['username'=>$this->to]);
    }
    
    public function getFromUser()
    {
        return User::findOne(['username'=>$this->from]);
    }
}