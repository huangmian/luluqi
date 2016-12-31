<?php
$this->title = Yii::t('common', 'Update').Yii::t('user', 'User').' : '.$model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'User').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="user-update"><?= $this->render('_form', ['model' => $model]) ?></div>