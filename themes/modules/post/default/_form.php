<?php 
use yii\helpers\Html;
use modules\post\models\Post;
use yii\bootstrap\ActiveForm;
?>
<div class='row'>
	<div class='col-md-9'>
		<div class='panel panel-default'>
            <div class='panel-body'>
            	<?php $form = ActiveForm::begin(['id'=>'UpdatePostForm']);?>
            		<?= $form->field($model,'title')->textInput()->label(Yii::t('post', 'Post').Yii::t('post', 'Title'));?>
            		<?= $form->field($model,'type_id')->dropDownList(Post::getFilterType());?>
            		<?= $form->field($model,'tag_id')->dropDownList(Post::getFilterTag());?>
            		<?= $form->field($model,'is_reprint')->dropDownList(Yii::$app->params['luluyiiGlobal']['is_reprint']);?>
            		<?= $form->field($model, 'content')->widget(lulubin\redactor\widgets\Redactor::className(), [
                        'clientOptions' => [
                            'lang'=>'zh_cn',
                            'plugins' => ['fontcolor','fontsize','fontfamily','fullscreen','imagemanager','table','textexpander']
                        ]
                    ])?>
            		<div class="form-group">
        				<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    				</div>
            	<?php ActiveForm::end();?>	
            </div>
        </div>
    </div>
    <div class='col-md-3'>
     <div class='panel panel-default'>
        <div class='panel-heading'><?=Html::encode('注意事项')?></div>
            <div class='panel-body'>
            	<ul>
                	<li>请输入完整的标题和内容</li>
                	<li>标题必须要有实际意义</li>
                	<li>请不要发和本站无关的话题</li>
                	<li>禁止只发链接，没有实际内容</li>
                	<li>发帖会增加金钱和威望</li>
                	<li>如果被删帖，扣除双倍金钱和威望</li>
                	<li>详细积分规则，请点此查看</li>
            	</ul>	
            </div>
        </div>
    </div>
</div>