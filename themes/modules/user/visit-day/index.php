<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use lulubin\ip2location\Ip2Location;
$this->title = Yii::t('user', 'VisitDay').Yii::t('common', 'Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-day-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'visit_ip',
                'value' => function ($model) {
                    $ipLocation = new Ip2Location();
                    $locationModel = $ipLocation->getLocation($model->visit_ip);
                    return $model->visit_ip.'　'.$locationModel->country.$locationModel->area;
                }
            ],
            [
                'attribute' => 'visit_time',
                'value' => function ($model){return date('Y-m-d H:i:s',$model->visit_time);}
            ],
            ['class' => 'yii\grid\ActionColumn','header' => "操作"],
        ],
        'export' => false,
        'pjax' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>'.$this->title.'</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']),
            'after' => false
        ],
    ]); ?>
</div>