<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'UserInfo').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-view">
    <p><?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'score',
            'signature',
            ['attribute' => 'sex',
                'value' => $model->sexName],
            'qq',
            'birthday',
            'location',
            'signin_day'
        ],
    ]) ?>
</div>