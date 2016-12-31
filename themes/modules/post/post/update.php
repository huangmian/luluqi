<?php
$this->title = Yii::t('common', 'Update').Yii::t('post', 'Post').':'.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="post-update"><?= $this->render('_form', ['model' => $model]) ?></div>