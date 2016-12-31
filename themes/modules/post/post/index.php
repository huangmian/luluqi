<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use modules\post\models\Post;
$this->title = Yii::t('post', 'Post').Yii::t('common', 'Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn','header' => "序号",],
            'id',
            'user_id',
            [
                'attribute' => 'is_visible',
                'value' => function ($model) {return $model->isVisible;},
                "filter" => Yii::$app->params['luluyiiGlobal']['is_visible']
            ],
            [
                'attribute' => 'is_top',
                'value' => function ($model) {return $model->isTop;},
                "filter" => Yii::$app->params['luluyiiGlobal']['is_top']
            ],
            [
                'attribute' => 'is_essence',
                'value' => function ($model) {return $model->isEssence;},
                "filter" => Yii::$app->params['luluyiiGlobal']['is_essence']
            ],
            [
                'attribute' => 'is_reprint',
                'value' => function ($model) {return $model->isReprint;},
                "filter" => Yii::$app->params['luluyiiGlobal']['is_reprint']
            ],
            'title',
            [
                'attribute' => 'type_id',
                'value' => function ($model) {return $model->postType;},
                "filter" => Post::getFilterType()
            ],
            [
                'attribute' => 'tag_id',
                'value' => function ($model) {return $model->postTag->tag_name;},
                "filter" => Post::getFilterTag()
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {return date('Y-m-d H:i:s',$model->created_at);}
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {return date('Y-m-d H:i:s',$model->updated_at);}
            ],
            ['class' => 'yii\grid\ActionColumn',"template" => "{view} {update} {delete}"],
        ],
        'toolbar' => [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                            'class' => 'btn btn-default',
                            'title' => 'Reset Grid'
                    ]),
                'options' => ['class' => 'btn-group-sm']
            ],
            '{export}',
            '{toggleData}'
        ],
        'toggleDataOptions'=>[
            'maxCount' => 200,//当超过200条时，此按钮隐藏，以免数据太多造成加载问题
            'minCount' => 10,//当现有总条数大于此值时,点击不会出现下方提示
            'confirmMsg' => '总共'. number_format($dataProvider->getTotalCount()).'条数据，确定要显示全部？',//点击时的确认
        ],
        'pjax' => true,
        'export' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> ' .$this->title. '</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>' .Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']),
            'after' => false
        ],
        //{export}设置，可导出excel，csv，pdf等各种类型的文件
        'export'=>[
            'fontAwesome'=>'fa fa-share-square-o',//图标
            'target'=>'_blank',//在新标签打开
            'encoding'=>'gbk',//编码
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