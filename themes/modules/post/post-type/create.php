<?php
$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post Types').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-type-create"><?= $this->render('_form', ['model' => $model]) ?></div>