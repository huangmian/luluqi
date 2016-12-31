<?php
$this->title = Yii::t('common', 'Update').':'.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('post', 'Post Types').Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->type_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="post-type-update"><?= $this->render('_form', ['model' => $model]) ?></div>