<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\helpers\Url;
?>
<div id="comment">
	<?= $post->comment_num?"<h4>共　<span class='text-danger'>$post->comment_num</span>条评论</h4>":"<h4 align='center'>暂时还没有评论，快来抢沙发吧~</h4>"?>
	<div class="col-4">
		<ul class="media-list">
		<?php foreach ($comments as $key=>$value):?>
			<li class='media'  data-key="<?=$value->id?>">
				<div class='media-left'>
					<?php echo $value->user->showImage(['width'=>'40','height'=>'40']);?>
				</div>
				<div class='media-body'>
					<div class='media-heading'>
						<?= Html::a($value->user->username,['/user/default/show','username'=>$value->user->username])." 评论于".\lulubin\date\DateStyle::widget(['sorce_date'=>$value->updated_at])?>
					</div>
					<p><?= $value->desc?></p>
					
					<?php foreach ($value->sons as $son):?>
                        <div class="media">
                            <div class="media-left">
                                <?php echo $son->user->showImage(['width'=>'40','height'=>'40'])?>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <a href="<?= Url::to(['/user/default/show', 'username' => $son->user->username])?>" rel="author" data-original-title="<?=$son->user->username?>" title=""><?=$son->user->username?>
                                    </a> 回复于 <?=\lulubin\date\DateStyle::widget(['sorce_date'=>$son->created_at])?>
                                    <span class="pull-right"><a class="reply-btn" href="javascript:;">回复</a></span>
                                </div>
                                <p><?= $son->desc?></p>
                            </div>
                        </div>
                    <?php endforeach;?>
                    
					<div class='media-action'>
						<a class="reply-btn" href="#">回复</a>
						<span class="vote pull-right">
    						<?= Html::a(Icon::show($value->isUp ? 'thumbs-up' : 'thumbs-o-up')." <em>$value->up</em>",['/post/post-vote','id'=>$value->id,'type'=>'comment','action'=>'up'],
    						    ['title'=>'','class'=>'up','data-toggle'=>"tooltip" ,'data-original-title'=>'顶'])?>
    					</span>
					</div>
				</div>
			</li>
    	<?php endforeach;?>
		</ul>
	</div>
</div>

<h4>发表评论</h4>
<?php if (Yii::$app->user->isGuest):?>
	<div class='well'>您需要登录后才可以评论。<?=Html::a('登录',["/user/default/login"])?> | <?=Html::a('立即注册',["/user/default/signup"])?></div>
<?php else :?>
    <?php $form = ActiveForm::begin(['id'=>'CommentForm']);?>
    	<?= $form->field($comment, 'desc')->textarea(['height'=>1000])->label(false)?>
    	<div class="form-group">
    		<?= Html::submitButton(Yii::t('post', 'Comment'), ['class'=>'btn btn-success']) ?>
    	</div>
    <?php ActiveForm::end();?>	
<?php endif;?>
<!--回复-->
<?php $form = \yii\widgets\ActiveForm::begin(['action' => Url::toRoute('/post/default/create-comment'), 'options' => ['class' => 'reply-form hidden']]); ?>
    <?= Html::hiddenInput(Html::getInputName($comment, 'post_id'), $post->id) ?>
    <?= Html::hiddenInput(Html::getInputName($comment, 'parent_id'), 0, ['class' => 'parent_id']) ?>
    <?= $form->field($comment, 'desc')->label(false)->textarea()?>
    <div class="form-group">
        <?php if (!Yii::$app->user->isGuest): ?>
            <button type="submit" class="btn btn-sm btn-primary">回复</button>
        <?php else: ?>
            <?= Html::a('登录', ['/user/default/login'], ['class' => 'btn btn-primary'])?>
        <?php endif; ?>
    </div>
<?php \yii\widgets\ActiveForm::end(); ?>