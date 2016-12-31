<?php
namespace modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class MassMessage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_message_system}}';
    }

    public function rules()
    {
        return [
            [['admin_id', 'content'], 'required'],
            [['admin_id'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'admin_id' => Yii::t('user', 'Admin ID'),
            'content' => Yii::t('post', 'Content'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
}