<?php
$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Mass Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mass-message-create"><?= $this->render('_form', ['model' => $model]) ?></div>