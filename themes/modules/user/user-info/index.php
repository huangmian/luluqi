<?php
use kartik\grid\GridView;
use modules\user\models\User;
$this->title = Yii::t('user', 'UserInfo').Yii::t('common', 'Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn','header' => "序号",],
            'user_id',
            [
                'attribute' => 'user_id',
                'header'=>Yii::t('user', 'Username'),
                'value' => function ($model) {return User::findOne(['id'=>$model->user_id])['username'];}],
            [
                'attribute' => 'image',
                'format' => ['image',["width"=>"40","height"=>"40"]],
                'value' => function ($model){
                return  Yii::$app->params['imageDomain'].'/'.$model->image;}
            ],
            [
                'attribute' => 'sex',
                'value' => function ($model) {return $model->sexName;},
                "filter" => Yii::$app->params['luluyiiGlobal']['sex']
                //"filter" => UserInfo::dropDown("sex")],
            ],
            'score',
            'signature',
            ['attribute' => 'qq','class'=>'kartik\grid\EditableColumn'],
            'birthday',
            'location',
            'signin_day',
            ['attribute' => 'last_login_time','value' => function ($model) {return date('Y-m-d H:i',$model->last_login_time);}],
            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update} ','header' => "操作"],
        ],
        'export' => false,
        'pjax' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> ' .$this->title. '</h3>',
            'type' => 'success',
            'after' => false
        ],
        'export'=>[
            'fontAwesome'=>'fa fa-share-square-o',
            'target'=>'_blank',
            'encoding'=>'gbk',
        ],
        'exportConfig' => [
            GridView::CSV => [
                'label' => '导出CSV',
                'iconOptions' => ['class' => 'text-primary'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => '用户表'.date("Y-m-d"),
                'alertMsg' => '确定要导出CSV格式文件？',
                'options' => [
                    'title'=>'',
                ],
                'mime' => 'application/csv',
                'config' => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ],
            ],
        ],
    ]); ?>
</div>