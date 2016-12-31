<?php
$this->title = Yii::t('common', 'Update').Yii::t('user', 'VisitDay').':'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'VisitDay').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="visit-day-update"><?= $this->render('_form', ['model' => $model]) ?></div>