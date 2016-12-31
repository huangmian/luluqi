<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'UserInfo').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="user-info-update"><?= $this->render('_form', ['model' => $model]) ?></div>