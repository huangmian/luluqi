<?php
namespace app\controllers;

use lulubin\qrcode\QrCode;

class SiteController extends \app\controllers\FrontController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionReward()
    {
        return $this->renderAjax('rewardModal');
    }
    
    public function actionDiary()
    {
        return $this->render('diary');
    }

    public function actionCoolSite()
    {
        return $this->render('coolSite');
    }
    
    public function actionQrcode($url)
    {
        return QrCode::png($url);
    }
}