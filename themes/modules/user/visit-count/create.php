<?php
$this->title = Yii::t('common', 'Create').Yii::t('user', 'VisitCount');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'VisitCount').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-count-create"><?= $this->render('_form', ['model' => $model]) ?></div>