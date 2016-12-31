<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = Yii::t('user', 'VisitCount').Yii::t('common', 'Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-count-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'nums',
            'created_time',
            ['class' => 'yii\grid\ActionColumn',
             'header' => "操作",
            ],
        ],
        'export' => false,
        'pjax' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>'.$this->title.'</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>' .Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']),
            'after' => false
        ],
    ]); ?>
</div>