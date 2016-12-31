<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = Yii::t('user', 'User').Yii::t('common', 'Manager').$model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'User').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <p>
	 	<?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),'method' => 'post']]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            ['attribute' => 'status',
            'value' => $model->statusName],
            'password_reset_token',
            'email',
            'registration_ip',
            'created_at',
        ],
    ]) ?>
</div>