<?php
namespace modules\post\models;

use Yii;
use modules\post\models\Post;
use modules\user\models\User;
use yii\behaviors\TimestampBehavior;
use modules\user\models\UserNotice;

class PostComment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post_comment}}';
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['post_id', 'user_id', 'desc',], 'required'],
            [['post_id', 'user_id', 'parent_id', 'up', 'down', 'created_at', 'updated_at'], 'integer'],
            [['desc'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'post_id' => Yii::t('post', 'Post ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'parent_id' => Yii::t('post', 'ParentComment ID'),
            'desc' => Yii::t('post', 'Desc'),
            'up' => Yii::t('post', 'Up'),
            'down' => Yii::t('post', 'Down'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
    
    //当前用户是否顶
    public function getIsUp()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $up = PostVote::findOne(['type_id' => $this->id, 'user_id' => $user_id, 'action' => 'up']);
            if ($up) {
                return true;
            }
        }
        return false;
    }
    
    //当前用户是否踩
    public function getIsDown()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $down = PostVote::findOne(['type_id' => $this->id, 'user_id' => $user_id, 'action' => 'down']);
            if ($down) {
                return true;
            }
        }
        return false;
    }
    
    public function comment($post_id)
    {
        $comment = new PostComment();
        $comment->post_id = $post_id;
        $comment->user_id = Yii::$app->user->id;
        $comment->desc = $this->desc;
        $comment->save();
        if ($comment->user_id != $comment->post->user_id){
            return UserNotice::setNotice($comment->user_id, $comment->post->user_id, 'comment');
        }
        return true;
    }
    
    //获取所有子评论.
    public function getSons()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }
    
    //绑定写入后的事件
    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'updateComment'], ['comment_num' => +1]);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'updateComment'], ['comment_num' => -1]);
    }
    
    //更新文章评论计数器
    public function updateComment($event)
    {
        $post = Post::find()->where(['id' => $this->post_id])->one();
        $post->updateCounters(['comment_num' => $event->data['comment_num']]);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}