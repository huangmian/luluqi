<?php
namespace modules\user\controllers;

use Yii;
use modules\user\models\UserNotice;
use app\controllers\FrontController;

class NoticeController extends FrontController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    ['actions' => ['index','message','focus','visit','collection','comment','vote','system'],
                        'allow' => true,'roles'=>['@']
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');
        if ($type){
            UserNotice::updateAllCounters(['is_read'=>1],['type'=>$type,'is_read'=>0]);
            return $this->redirect('/user/notice/'.$type);
        }
        return $this->render('notice',['type'=>$type]);
    }
    
    public function actionMessage()
    {
        return $this->render('notice',['type'=>'message']);
    }
    
    public function actionFocus()
    {
        return $this->render('notice',['type'=>'focus']);
    }
    
    public function actionVisit()
    {
        return $this->render('notice',['type'=>'visit']);
    }
    
    public function actionCollection()
    {
        return $this->render('notice',['type'=>'collection']);
    }
    
    public function actionComment()
    {
        return $this->render('notice',['type'=>'comment']);
    }
    
    public function actionVote()
    {
        return $this->render('notice',['type'=>'vote']);
    }
    
    public function actionSystem()
    {
        return $this->render('notice',['type'=>'system']);
    }
}
