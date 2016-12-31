<?php
namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;

class UserAuth extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_auth}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'source', 'source_id'], 'required'],
            [['user_id'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'source' => Yii::t('user', 'Source'),
            'source_id' => Yii::t('user', 'Source ID'),
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
}