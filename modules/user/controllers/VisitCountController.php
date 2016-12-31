<?php
namespace modules\user\controllers;

use Yii;
use modules\user\models\VisitCount;
use modules\user\models\search\VisitCountSearch;
use yii\web\NotFoundHttpException;
use app\controllers\BackController;

class VisitCountController extends BackController
{
    public function actionIndex()
    {
        $searchModel = new VisitCountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate()
    {
        $model = new VisitCount();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = VisitCount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}