<?php
namespace modules\post\controllers;

use Yii;
use modules\post\models\Post;
use yii\web\NotFoundHttpException;
use modules\user\models\User;
use yii\data\Pagination;
use modules\post\models\PostCollection;
use yii\web\Response;
use yii\base\InvalidParamException;
use modules\post\models\PostComment;
use modules\user\models\UserNotice;
use modules\post\models\PostType;
use modules\post\models\PostTag;
use app\controllers\FrontController;

class DefaultController extends FrontController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'only' => ['index','create-post','update-post','collect','show-post'],
                'rules' => [
                    ['actions' => ['create-post','update-post','collect'],
                        'allow' => true,'roles'=>['@']
                    ],
                    ['actions' => ['show-post'],
                        'allow' => true ,'roles'=> ['?','@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'collect' => ['post'],
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['essence'],
                'duration' => 3600*24,
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM lulu_post WHERE is_essence=1',
                ],
            ],
        ];
    }

    public function actionShowPost($id)
    {
        $post = $this->findModel($id);
        $post->addView();
        $comments = PostComment::find()->where(['post_id'=>$id,'parent_id'=>0])->all();
        $comment = new PostComment();
        if ($comment->load(Yii::$app->request->post()) && $comment->comment($id)) {
            return $this->refresh();
        }
        return $this->render('showPost',['post'=>$post,'comment'=>$comment,'comments'=>$comments]);
    }
    
    public function actionCreateComment()
    {
        $model = new PostComment();
        $model->load(Yii::$app->request->post());
        $model->user_id = Yii::$app->user->id;
        $from_username = Yii::$app->user->identity->username;
        $to_username = mb_substr($model->desc, '1',strpos($model->desc,' ')-1);
        if($from_username == $to_username){
            Yii::$app->session->setFlash('error', '不能回复自己');
        }else if ($model->save()) {
            $to_user_id = User::findOne(['username'=>$to_username])['id'];
            UserNotice::setNotice($model->user_id, $to_user_id, 'comment');
            Yii::$app->session->setFlash('success', '评论成功！');
        } else {
            Yii::$app->session->setFlash('error', '评论失败！');
        }
        return $this->redirect(Yii::$app->request->getReferrer());
    }
    
    public function actionShowPosts()
    {
        $type_id = Yii::$app->request->get('type_id');
        $sons_id = PostType::getSonsId($type_id);
        $count = Post::find()->where(['is_visible'=>1])->andWhere(['in','type_id',$sons_id])->count();//总页数
        $pages = new Pagination([
            'totalCount' =>$count, 
            'pageSize' => Yii::$app->params['pageSize']['many'],
            //'pageSize' => 5, //默认分页的数量是20，你可以设置pageSize为你想要的
            //'pageSizeParam' => false, //从上面的分页路由我们可以看到，默认带的有每页的数量per-page 如果你不想显示该参数，设置pageSizeParam=false就好
            //'pageParam' => 'p',//默认的页面取决于参数page,如果你想改变该参数为p,设置pageParam=p就好
            //'route' => false,//如果你的分页存在于首页，相信你肯定想要/?p=1而不是/site/index?p=1，我们看看怎么隐藏掉路由
        ]);//Pagination对象
        $filter = Yii::$app->request->get('filter')?Yii::$app->request->get('filter'):'view_num';
        $model = $this->findType($type_id,$sons_id,$filter)->offset($pages->offset)->limit($pages->limit)->all();//根据点击页码进行查询
        return $this->render('showPosts',['model'=>$model,'type_id'=>$type_id,'pages'=>$pages]);
    }
    
    public function actionCreatePost()
    {
        $model = new Post();
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','成功发布');
            return $this->refresh();
        }
        return $this->render('createPost', ['model' => $model]);
    }

    public function actionUpdatePost($id)
    {
        $model = $this->findModel($id);
        if ($model->user->username != Yii::$app->user->identity->username){
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->getSession()->setFlash('success','修改成功');
            return $this->refresh();
        }
        return $this->render('updatePost',['model'=>$model]);
    }
    
    public function actionCollect()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post_id = Yii::$app->request->get('id');
        if (empty($post_id)) {
            throw new InvalidParamException('参数不合法');
        }
        $post = $this->findModel($post_id);
        if (empty($post)) {
            throw new NotFoundHttpException('文章不存在');
        }
        $collection = PostCollection::find()->where(['user_id' => Yii::$app->user->id, 'post_id' => $post_id])->one();
        if (empty($collection)) {
            $collection = new PostCollection();
            $collection->user_id = Yii::$app->user->id;
            $collection->post_id = $post_id;
            $collection->created_time = time();
            $collection->save();
            $post->updateCounters(['collection' => +1]);
            if ($collection->user_id != $collection->post->user_id){
                UserNotice::setNotice($collection->user_id, $collection->post->user_id, 'collection');
            }
            return ['action' => 'create','count' => $post->collection];
        } else {
            $collection->delete();
            $post->updateCounters(['collection' => -1]);
            if ($collection->user_id != $collection->post->user_id){
                UserNotice::deleteNotice('collection', $collection->post->user_id);
            }
            return ['action' => 'cancel','count' => $post->collection];
        }
    }
    
    public function actionMyCollect()
    {
        $count = PostCollection::find()->where(['user_id'=>Yii::$app->user->id])->count();
        $pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['less']]);
        $collect = PostCollection::find()->where(['user_id'=>Yii::$app->user->id])->orderBy(['created_time'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('myCollect',['collect'=>$collect,'pages'=>$pages]);
    }
    
    public function actionMyPost()
    {
        $count = Post::find()->where(['user_id'=>Yii::$app->user->id])->count();
        $pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['many']]);
        $post = Post::find()->where(['user_id'=>Yii::$app->user->id])->orderBy(['created_at'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('myPost',['post'=>$post,'pages'=>$pages]);
    }
    
    public function actionShowUserPost($user_id)
    {
        $user = User::findOne(['id'=>$user_id]);
        $count = Post::find()->where(['user_id'=>$user_id])->count();
        $pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['many']]);
        $post = Post::find()->where(['user_id'=>$user_id])->orderBy(['created_at'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('myPost',['post'=>$post,'pages'=>$pages,'user'=>$user]);
    }
    
    public function actionSearchPost()
    {
        $title = Yii::$app->request->get('title');
        $query = Post::find()->andFilterWhere(['like','title',$title])->orFilterWhere(['like','content',$title]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['many']]);
        $res = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('searchPost',['res'=>$res,'title'=>$title,'pages'=>$pages,'count'=>$count]);
    }
    
    public function actionShowPostsByTag()
    {
        $tag_name = Yii::$app->request->get('tag_name');
        $tag_id = PostTag::findOne(['tag_name'=>$tag_name])->id;
        $query = Post::find()->where(['tag_id'=>$tag_id]);
        $pages = new Pagination(['totalCount'=>$query->count(),'pageSize' => Yii::$app->params['pageSize']['many']]);
        return $this->render('showPostsByTag',['tags'=>$query->orderBy(['is_top'=>SORT_DESC,'view_num'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all(),'pages'=>$pages,]);
    }
    
    protected function findModel($id)
    {
        if (($model = Post::find()->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findType($type_id,$sons_id,$filter)
    {
        if (($model = Post::find()->where(['in','type_id',$sons_id])->orderBy(['is_top'=>SORT_DESC,$filter=>SORT_DESC])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}