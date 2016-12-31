<?php 
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- 打赏支持modal -->
<div class="support-author">
    <p>如果觉得我的文章对您有用，请随意打赏。您的支持将鼓励我继续创作！</p>
    <?= Html::a('¥ 打赏支持', '#', [
        'id' => 'create',
        'data-toggle' => 'modal',
        'data-target' => '#pay-modal',
        'class' => 'btn btn-pay',
        'style' => "color: #fff; padding: 10px 20px; font-size: 14px; border-radius: 5px;"
    ]);?>
</div><hr />
<?php 
Modal::begin([
    'id' => 'pay-modal',
    'header' => '<h4 class="modal-title">打赏支持</h4>',
]);
$requestUrl = Url::toRoute('/site/reward');
$js = <<<JS
    $.get('{$requestUrl}', {},
        function (data) {
            $('.modal-body').html(data);
        }
    );
JS;
$this->registerJs($js);
Modal::end();
?>