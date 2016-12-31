<?php
namespace modules\post\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class PostTag extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_tag}}';
    }
    public function rules()
    {
        return [
            [['tag_name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'Tag ID'),
            'tag_name' => Yii::t('post', 'Tag Name'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
    
    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }
}