<?php
$this->title = Yii::t('user', 'Create Visit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-create"><?= $this->render('_form', ['model' => $model]) ?></div>