<?php
$this->title = Yii::t('common', 'Update').':'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'VisitCount').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="visit-count-update"><?= $this->render('_form', ['model' => $model]) ?></div>