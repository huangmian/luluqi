<?php
namespace modules\post\models;

use Yii;
use yii\helpers\ArrayHelper;

class PostType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_type}}';
    }
    
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['parent_id', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type_id' => Yii::t('common', 'Type ID'),
            'parent_id' => Yii::t('post', 'ParentType ID'),
            'name' => Yii::t('common', 'Type Name'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
    
    public function getSons()
    {
        return self::findAll(['parent_id'=>$this->type_id]);
    }
    
    public static function getParent($type_id)
    {
        $parent_id = self::findOne(['type_id'=>$type_id])['parent_id'];
        return self::findOne(['type_id'=>$parent_id]);
    }
    
    public  static function getSonsId($type_id)
    {
        return ArrayHelper::map(PostType::find()->where(['type_id'=>$type_id])->orwhere(['parent_id'=>$type_id])->all(), 'type_id', 'type_id');
    }
}