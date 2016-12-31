<?php
$this->title = Yii::t('common', 'Update').':'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Visit').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="visit-update"><?= $this->render('_form', ['model' => $model]) ?></div>