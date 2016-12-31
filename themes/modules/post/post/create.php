<?php
$this->title = Yii::t('common', 'Create').Yii::t('post', 'Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create"><?= $this->render('_form', ['model' => $model]) ?></div>