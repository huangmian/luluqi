<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
$this->title = Yii::t('user', 'Score Focus');
$user_info = $user->userInfo;
?>
<?php if (in_array(Yii::$app->controller->action->id, ['show-score'])):?>
<div class='row'>
<?php endif;?>
    <div class='col-md-3'><?= $this->render('/default/navLeft')?></div>
    <div class='col-md-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <h3 class='panel-title'><?=Html::encode($this->title)?></h3>
            </div>
        	<?= DetailView::widget(
        	    ['model'=>$user_info,
    	        'attributes' => [
        	       'score',
    	            ['attribute' => '粉丝数量',
    	            'format' => 'raw',
    	            'value' => '<span class="badge">'.$user->fansNum.'</span>'.Html::a('全部粉丝',['show-fans2','username'=>$user->username],['class'=>'pull-right'])],
    	            ['attribute' => '关注数量',
    	                'format' => 'raw',
    	                'value' => '<span class="badge">'.$user->focusNum.'</span>'.Html::a('全部关注',['show-focus2','username'=>$user->username],['class'=>'pull-right'])],
        	]])?>
        </div>
    </div>
<?php if (in_array(Yii::$app->controller->action->id, ['show-score'])):?>
</div>
<?php endif;?>