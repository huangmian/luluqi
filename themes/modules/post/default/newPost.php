<?php
use modules\post\models\Post;
use yii\widgets\LinkPager;
use yii\data\Pagination;
$count = Post::find()->where(['is_visible'=>1])->count();
$pages = new Pagination([
    'totalCount' =>$count,
    'pageSize' => 16,
]);
$new_post = Post::find()->where(['is_visible'=>1])->orderBy(['is_top'=>SORT_DESC,'created_at'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
?>
<div class='panel panel-default'>
    <?= $this->render('@themes/modules/post/default/commonPostList',['res'=>$new_post]) ?>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
</div>