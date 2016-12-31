<?php
use modules\post\models\post;
use modules\post\models\PostType;
$this->title = Yii::t('common', 'Update').' - '.$model->title;
$parentType = PostType::getParent($model->type_id);
if ($parentType){
    $this->params['breadcrumbs'][] = ['label' => $parentType->name, 'url' => ['show-posts','type_id'=>$parentType->type_id]];
}
$this->params['breadcrumbs'][] = ['label'=>$model->postType,'url'=>['show-posts','type_id'=>$model->type_id]];
$this->params['breadcrumbs'][] = ['label'=>$model->title,'url'=>['show-post','id'=>$model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<?= $this->render('_form',['model'=>$model])?>