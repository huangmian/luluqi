<?php
namespace modules\user\models;

use Yii;
use yii\db\ActiveRecord;

class VisitCount extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_visit_count}}';
    }

    public function rules()
    {
        return [
            [['nums'], 'required'],
            [['nums'], 'integer'],
            [['created_time'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'nums' => Yii::t('user', 'Nums'),
            'created_time' => Yii::t('common', 'Created At'),
        ];
    }
}
