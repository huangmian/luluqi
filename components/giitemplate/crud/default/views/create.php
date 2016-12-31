<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
echo "<?php\n";
?>
$this->title = Yii::t('common', 'Create').<?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>.Yii::t('common', 'Manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">
    <?= "<?= " ?>$this->render('_form', ['model' => $model]) ?>
</div>
