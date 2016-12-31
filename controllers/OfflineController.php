<?php
namespace app\controllers;

class OfflineController extends \app\controllers\FrontController
{    
    public function actionIndex($param1,$param2)
    {
        return $this->render('index',['param1'=>$param1,'param2'=>$param2]);
    }
}