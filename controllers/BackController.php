<?php
namespace app\controllers;

use Yii;

class BackController extends \yii\web\Controller
{
   public function behaviors()
   {
       return [
           'verbs' => [
               'class' => 'yii\filters\VerbFilter',
               'actions' => [
                   'delete' => ['post'],
               ],
           ],
           'access' => [
               'class' => 'yii\filters\AccessControl',
               'rules' => [
                   [
                       'allow' => true,
                       'roles' => ['@'],
                       'matchCallback' => function () {
                           return in_array(Yii::$app->user->identity->username, Yii::$app->params['adminName']);
                       },
                   ]
               ],
           ],
       ];
   }
}