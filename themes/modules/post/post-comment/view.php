<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Comment').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-view">
    <p>
	 	<?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),'method' => 'post']]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'post_id',
            'user_id',
            'parent_id',
            'desc',
            'up',
            'down',
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>