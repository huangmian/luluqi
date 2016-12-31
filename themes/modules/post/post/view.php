<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <p>
	 	<?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),'method' => 'post']]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'type_id',
            'title',
            ['attribute' => 'is_visible','value' => $model->isVisible],
            ['attribute' => 'is_top','value' => $model->isTop],
            ['attribute' => 'is_essence','value' => $model->isEssence],
            ['attribute' => 'is_reprint','value' => $model->isReprint],
            'up',
            'down',
            'comment_num',
            'view_num',
            'collection',
            'content',
            'type_id',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>