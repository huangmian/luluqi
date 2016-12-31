<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = Yii::t('user', 'Mass Message');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mass-message-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'admin_id',
            'content',
            ['attribute'=>'created_at',
              'value'=>function($model){
                return date('Y-m-d H:i:s',$model->created_at);} ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete} ',
            'header' => "操作",
            ],
        ],
        'export' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>'.Yii::t('user', 'Mass Message').' —— 注意：管理员发送站内信之后不能修改，若想修改，请删除之后重新发送</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>' .Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']),
            'after' => false
        ],
    ]); ?>
</div>