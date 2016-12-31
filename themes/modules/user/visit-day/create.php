<?php
$this->title = Yii::t('common', 'Create').Yii::t('user', 'VisitDay');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'VisitDay').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-day-create"><?= $this->render('_form', ['model' => $model]) ?></div>