<?php
namespace modules\post\models;

use Yii;

class PostCollection extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_collection}}';
    }

    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'post_id' => Yii::t('post', 'Post ID'),
            'user_id' => Yii::t('post', 'User ID'),
        ];
    }
    
    public function getPost()
    {
        return Post::findOne(['id'=>$this->post_id]);
    }
}
