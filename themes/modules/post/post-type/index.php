<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = Yii::t('post', 'Post Types').Yii::t('common', 'Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-type-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type_id',
            'parent_id',
            'name',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {return date('Y-m-d H:i:s',$model->created_at);}
            ],
            ['class' => 'yii\grid\ActionColumn','header' => "操作"],
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