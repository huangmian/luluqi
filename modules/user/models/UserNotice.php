<?php
namespace modules\user\models;

use yii\db\ActiveRecord;
use modules\post\models\PostComment;
use yii\helpers\Html;
use modules\post\models\PostCollection;
use modules\post\models\PostVote;

class UserNotice extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_notice}}';
    }

    public function rules()
    {
        return [
            [['from_user_id','to_user_id','type'], 'required'],
            [['from_user_id','to_user_id', 'is_read', 'created_time'], 'integer'],
            [['type'], 'string', 'max' => 10],
        ];
    }
    
    public static function setNotice($from_user_id,$to_user_id,$type,$time='')
    {
        $notice = new UserNotice();
        $notice->created_time = $time?$time:time();
        $notice->from_user_id = $from_user_id;
        $notice->to_user_id = $to_user_id;
        $notice->type = $type;
        if ($notice->validate()){
            return $notice->save();
        }
    }
    
    public static function updateNotice($to_user_id,$type)
    {
        $notice = UserNotice::findOne(['type'=>$type,'to_user_id'=>$to_user_id]);
        $notice->created_time = time();
        $notice->is_read = 0;
        return $notice->save();
    }
    
    public static function deleteNotice($type,$to_user_id)
    {
        $notice = UserNotice::findOne(['type'=>$type,'to_user_id'=>$to_user_id]);
        return $notice->delete();
    }

    public function getNoticesZh()
    {
        switch ($this->type) {
            case 'visit':
                return $this->getNoticeNumByType().'位新访客';
                break;
            case 'message':
                return $this->getNoticeNumByType().'条新私信';
                break;
            case 'comment':
                if ($this->comment['parent_id'] == 0){
                    return $this->getNoticeNumByType().'条新评论';
                }else{
                    return $this->getNoticeNumByType().'条新回复';
                }
                break;
            case 'collection':
                return $this->getNoticeNumByType().'人收藏了您';
                break;
            case 'focus':
                return $this->getNoticeNumByType().'位新粉丝';
                break;
            case 'vote':
                if ($this->vote['action'] == 'up'){
                    return $this->getNoticeNumByType().'人赞了您';
                }else{
                    return $this->getNoticeNumByType().'人踩了您';
                }
                break;
            case 'system':
                return $this->getNoticeNumByType().'条系统消息';
                break;
            default:
                return false;
                break;
        }
    }
    
    protected function getNoticeNumByType()
    {
        return $this->find()->where(['type'=>$this->type,'is_read'=>0,'to_user_id'=>$this->to_user_id])->count();
    }
    
    public function getFromUser()
    {
        return User::findOne(['id'=>$this->from_user_id]);
    }
    
    public function getMessage()
    {
        return UserMessage::findOne(['send_time'=>$this->created_time]);
    }
    
    public function getComment()
    {
        return PostComment::findOne(['created_at'=>$this->created_time]);
    }
    
    public function getCollection()
    {
        return PostCollection::findOne(['created_time'=>$this->created_time]);
    }
    
    public function getVote()
    {
        return PostVote::findOne(['vote_time'=>$this->created_time]);
    }
    
    public function getNoticeZh()
    {
        switch ($this->type) {
            case 'visit':
                return '访问了您的主页';
                break;
            case 'message':
                if ($this->message['parent_id'] == 0){
                    return '给您发私信了';
                }else{
                    return '回复了您的私信';
                }
                break;
            case 'comment':
                if ($this->comment['parent_id'] == 0){
                    return '评论了您的教程 '.Html::a($this->comment['post']['title'],['/post/default/show-post','id'=>$this->comment['post']['id']]);
                }else{
                    return '回复了您对于 '.Html::a($this->comment->post->title,['/post/default/show-post','id'=>$this->comment->post->id]).' 的评论';
                }
                break;
            case 'focus':
                return '关注了您';
                break;
            case 'collection':
                return '收藏了您的教程';
                break;
            case 'vote':
                if ($this->vote['action'] == 'up'){
                    if ($this->vote['type']=='post'){
                        return '赞了您的教程';
                    }else{
                        return '赞了您对教程 '.Html::a($this->vote['typeModel']['post']['title'],['/post/default/show-post','id'=>$this->vote['typeModel']['post_id']]).' 的评论';
                    }
                }else{
                    if ($this->vote['type']=='post'){
                        return '踩了您的教程';
                    }else{
                        return '踩了您对教程 '.Html::a($this->vote['typeModel']['post']['title'],['/post/default/show-post','id'=>$this->vote['typeModel']['post_id']]).' 的评论';
                    }
                }
                break;
            case 'system':
                return '管理员给您发了系统消息';
                break;
            default:
                return false;
                break;
        }
    }
    
    public function getNoticeTage()
    {
        switch ($this->type) {
            case 'visit':
                return '回访';
                break;
            case 'message':
                if ($this->message['parent_id'] == 0){
                    return '回复';
                }else{
                    return '查看';
                }
                break;
            case 'comment':
                return '查看';
                break;
            case 'focus':
                return '回访';
                break;
            case 'vote':
                return '查看';
                break;
            case 'system':
                return '回复';
                break;
            default:
                return false;
                break;
        }
    }
    
    public function getNoticeUrl()
    {
        switch ($this->type) {
            case 'visit':
                return ['default/show','username'=>$this->fromUser->username];
                break;
            case 'message':
                return ['default/view-message','id'=>$this->message['parent_id'] ? $this->message['parent_id'] : $this->message['id']];
                break;
            case 'comment':
                return ['/post/default/show-post','id'=>$this->comment['post']['id'],'#'=>'comment'];
                break;
            case 'focus':
                return ['default/show','username'=>$this->fromUser->username];
                break;
            case 'vote':
                if ($this->vote['type']=='post'){
                    return ['/post/default/show-post','id'=>$this->vote['typeModel']['id'],'#'=>'action'];
                }else{
                    return ['/post/default/show-post','id'=>$this->vote['typeModel']['post_id'],'#'=>'action'];
                }
                break;
            case 'system':
                return ['default/view-message','id'=>$this->message['parent_id'] ? $this->message['parent_id'] : $this->message['id']];
                break;
            default:
                return false;
                break;
        }
    }
}