<?php
namespace modules\post\models;

use Yii;
use modules\post\models\Post;
use modules\post\models\PostComment;
use modules\user\models\User;

class PostVote extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_vote}}';
    }

    public function rules()
    {
        return [
            [['type_id', 'user_id', 'vote_time'], 'required'],
            [['type_id', 'user_id', 'vote_time'], 'integer'],
            [['action','type'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'type_id' => Yii::t('post', 'Type ID'),
            'user_id' => Yii::t('post', 'User ID'),
            'type' => Yii::t('post', 'Type'),
            'action' => Yii::t('post', 'Action'),
            'created_at' => Yii::t('post', 'Vote Time'),
        ];
    }
    
    public function getTypeModel()
    {
        if ($this->type == 'post') {
            return Post::findOne(['id'=>$this->type_id]);
        }else{
            return PostComment::findOne(['id'=>$this->type_id]);
        }
    }
    
    public function getUser() 
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
}