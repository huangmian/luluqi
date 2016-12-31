<?php
$this->title = Yii::t('common', 'Create').Yii::t('post', 'Post');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form',['model'=>$model])?>