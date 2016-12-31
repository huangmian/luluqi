<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">
    <?= "<?php " ?>$form = ActiveForm::begin(['action' => ['index'],'method' => 'get']); ?>
<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 20) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    } else {
        echo "    <?php  echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    }
}
?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
