<?php
$this->title = Yii::t('common', 'Create').Yii::t('post', 'Post Tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post Tags').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-tag-create"><?= $this->render('_form', ['model' => $model]) ?></div>