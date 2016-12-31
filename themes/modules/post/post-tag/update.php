<?php
$this->title = Yii::t('common', 'Update').Yii::t('post', 'Post Tags').':'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post Tags').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="post-tag-update"><?= $this->render('_form', ['model' => $model]) ?></div>