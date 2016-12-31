<?php
$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Comment').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-create"><?= $this->render('_form', ['model' => $model]) ?></div>