<?php
namespace modules\post\controllers;

use Yii;
use yii\web\Response;
use modules\post\models\Post;
use modules\post\models\PostVote;
use modules\post\models\PostComment;
use modules\user\models\UserNotice;
use app\controllers\FrontController;

class PostVoteController extends FrontController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $action = Yii::$app->request->get('action');
        $type = Yii::$app->request->get('type');
        $type_id = Yii::$app->request->get('id');
        $user_id = Yii::$app->user->id;
    
        $actions = ['up', 'down'];
        //array_search() 函数在数组中搜索某个键值，并返回对应的键名，即'up'返回'0'，'down'返回'1'
        //array_splice() 从数组中移除元素，并用新元素取代它；如果'up'，将'up'移除，表示用户只可以'down'了
        array_splice($actions, array_search($action, $actions), 1);
        $oppositeAction = current($actions);
        
        $model = $this->findModel($type_id,$type);
        $vote = PostVote::find()->where(['type_id' => $type_id,'user_id' => $user_id])->one();
        if (empty($vote)) {
            if ($user_id != $model->user_id){
                UserNotice::setNotice($user_id, $model->user_id, 'vote');
            }
            //更新当前model，对post表的up/down字段+1
            $model->updateCounters([$action => 1]);
            $vote = new PostVote();
            $params = [
                'action' => $action,
                'type' => $type,
                'type_id' => $type_id,
                'user_id' => $user_id,
                'vote_time' => time(),
            ];
            $vote->attributes = $params;
            $vote->save();
        } else {
            // 一篇文章只能持一个态度（顶或者踩,不能同时顶和踩）
            if ($vote->action != $action) {
                if ($user_id != $model->user_id){
                    UserNotice::updateNotice($model->user_id, 'vote');
                }
                $vote->action = $action;
                $vote->save();
                //如果'up'，post表中up+1，down-1
                $model->updateCounters([$action => 1, $oppositeAction => -1]);
            }
        }
        return ['up' => $model->up,'down' => $model->down];
    }
    
    private function findModel($type_id, $type)
    {
        if ($type == 'post') {
            $model = Post::find()->where(['id' => $type_id])->select('id,user_id,up,down')->one();
        } else {
            $model = PostComment::find()->where(['id' => $type_id])->select('id,user_id,up,down')->one();
        }
        return $model;
    }
}