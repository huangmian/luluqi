<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-type-view">
   <p>
	 	<?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),'method' => 'post']]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'parent_id',
            'type_id',
            'name',
            'created_at:datetime',
        ],
    ]) ?>
</div>