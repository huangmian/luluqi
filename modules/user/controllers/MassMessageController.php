<?php
namespace modules\user\controllers;

use Yii;
use modules\user\models\MassMessage;
use modules\user\models\search\MassMessageSearch;
use yii\web\NotFoundHttpException;
use app\controllers\BackController;

class MassMessageController extends BackController
{
    public function actionIndex()
    {
        $searchModel = new MassMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate()
    {
        $model = new MassMessage();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = MassMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
