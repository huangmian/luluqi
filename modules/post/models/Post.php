<?php
namespace modules\post\models;

use Yii;
use modules\user\models\User;
use yii\behaviors\TimestampBehavior;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'content', 'type_id', 'tag_id'], 'required'],
            [['user_id', 'type_id', 'tag_id', 'is_visible', 'is_top', 'is_essence','is_reprint','up', 'down', 'comment_num', 'view_num', 'collection'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 10485760],
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
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'Post ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'title' => Yii::t('post', 'Title'),
            'is_visible' => Yii::t('post', 'Is Visible'),
            'is_top' => Yii::t('post', 'Is Top'),
            'is_essence' => Yii::t('post', 'Is Essence'),
            'is_reprint' => Yii::t('post', 'Is Reprint'),
            'up' => Yii::t('post', 'Up'),
            'down' => Yii::t('post', 'Down'),
            'comment_num' => Yii::t('post', 'Comment Num'),
            'view_num' => Yii::t('post', 'View Num'),
            'collection' => Yii::t('post', 'Collection'),
            'content' => Yii::t('post', 'Content'),
            'type_id' => Yii::t('post', 'Post Types'),
            'tag_id' => Yii::t('post', 'Post Tags'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
    
    public static function PostType($type)
    {
        return PostType::findOne(['type_id'=>$type])->name;
    }
    
    public function getPostType()
    {
        return PostType::findOne(['type_id'=>$this->type_id])->name;
    }
    
    public function getPostTag()
    {
        return PostTag::findOne(['id'=>$this->tag_id]);
    }
    
    public static function getFilterType($dd='>>')
    {
        $types = PostType::find()->all();
        foreach ($types as $key=>$val){
            if (!$parent = PostType::getParent($val->type_id)){
                $types_name[$val->type_id] = $val->name;
            }else{
                $types_name[$val->type_id] = $parent->name.$dd.$val->name;
            }
        }
        return $types_name;
    }
    
    public static function getFilterTag()
    {
        $tags = PostTag::find()->all();
        foreach ($tags as $key=>$val){
            $tag_name[$val->id] = $val->tag_name;
        }
        return $tag_name;
    }
    
    public function getIsVisible()
    {
        switch ($this->is_visible){
            case '0':
                return '不可见';
                break;
            case '1':
                return '可见';
                break;
            default:
                return NUll;
                break;
        }
    }
    
    public function getIsTop() 
    {
        switch ($this->is_top){
            case '0':
                return '不置顶';
                break;
            case '1':
                return '置顶';
                break;
            default:
                return NUll;
                break;
        }
    }
    
    public function getIsEssence()
    {
        switch ($this->is_essence){
            case '0':
                return '非精华';
                break;
            case '1':
                return '精华';
                break;
            default:
                return NUll;
                break;
        }
    }
    
    public function getIsReprint()
    {
        switch ($this->is_reprint){
            case '0':
                return '原创';
                break;
            case '1':
                return '转载';
                break;
            default:
                return NUll;
                break;
        }
    }
    
    //文章的真正查看次数
    public function getTrueView()
    {
        return $this->view_num + \Yii::$app->cache->get('post:view:' . $this->id);
    }
    
    //增加文章的查看次数
    public function addView()
    {
        $session = Yii::$app->session;
        $key = 'post_'.$this->id;
        $val = Yii::$app->request->userIp;
        $old_arr = (array)$session->get($key);
        if (!in_array($val, $old_arr)){
            $session->set($key,[$old_arr,$val]);
            $this->view_num += 1;
            $this->save(false);
        }
        return true;
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
    
    //顶的用户列表
    public function getUpUsers()
    {
        return PostVote::findAll(['type'=>'post', 'type_id' => $this->id, 'action' => 'up']);
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
    
    //当前用户是否收藏
    public function getIsCollect()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $collection = PostCollection::find()->where(['post_id' => $this->id, 'user_id' => $user_id])->one();
            if ($collection) {
                return true;
            }
        }
        return false;
    }
    
    public function getNoticeUser()
    {
        return User::findOne(['id'=>$this->user_id]);
    }
    
    public function getCollectionNum()
    {
        return $this->collection?$this->collection:'收藏';
    }
    
    public function getUpNum()
    {
        return $this->up?$this->up:'赞';
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
}