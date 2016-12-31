<?php
namespace app\controllers;

use Yii;

class FrontController extends \yii\web\Controller
{
    //默认的操作
    //public $defaultAction = 'index';

    public function init()
    {
        parent::init();
        \modules\user\models\Visit::ExitVisit(); //统计建站后的访问量
        \modules\user\models\VisitDay::ExitVisit(); //统计当天的访问量
        if (!Yii::$app->user->isGuest){
            \modules\user\models\UserInfo::ExitLogin(); //判断用户是否在线
        }
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}