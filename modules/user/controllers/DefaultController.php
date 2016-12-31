<?php
namespace modules\user\controllers;

use Yii;
use yii\helpers\Html;
use modules\user\models\form\LoginForm;
use modules\user\models\form\SigninForm;
use modules\user\models\form\FindPasswordForm;
use modules\user\models\form\ResetPasswordForm;
use modules\user\models\form\ModifyPasswordForm;
use modules\user\models\form\SendMessageForm;
use modules\user\models\form\SignupForm;
use modules\user\models\UserInfo;
use modules\user\models\User;
use modules\user\models\UserMessage;
use modules\user\models\UserFans;
use modules\user\models\VisitCount;
use modules\user\models\UserNotice;
use modules\user\models\UserAuth;
use yii\web\Response;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\web\ServerErrorHttpException;

class DefaultController extends \app\controllers\FrontController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'only' => ['captcha','logout','signin','activate-account','find-password','reset-password','modify-password','modify-info','modify-image','send-message',
                           'focus','show-fans','show-fans2','show-focus','show-focus2','view-message'],
                'rules' => [
                    ['actions' => ['captcha','activate-account','find-password','reset-password'],'allow' => true,'roles'=>['?']],
                    ['actions' => ['logout','modify-password','modify-info','modify-image','signin','send-message','focus','show-fans','show-fans2','show-focus','show-focus2','view-message'],
                                    'allow' => true,'roles'=>['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'logout' => ['post'],
                    'focus' => ['post'],
                    'signin' => ['post'],
                ],
            ],
            [
                'class' => 'yii\filters\PageCache',
                //页面缓存，缓存展示七天访客数量的页面，缓存24小时
                'only' => ['show-visit'],
                'duration' => 3600*24,
                //当存储每天的访问人数总数放生改变的时候，缓存失效
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM lulu_user_visit_count',
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'maxLength' =>5,
                'minLength' =>4,
                'testLimit'=>5,
                //fixedVerifyCode通常用在自动化测试 方便复制验证码的场景下使用
                //每次都固定显示一个验证码，方便测试，方便开发
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }
    
    public function onAuthSuccess($client)
    {
        $attr = $client->getUserAttributes();
        $auth = UserAuth::find()->where(['source' => $client->id,'source_id' => $attr['id']])->one();
        //检测是否是已登录用户，如果是未登录用户则检测是否存在绑定记录（存在则直接登录，未存在则要求绑定或者创建账号），如果是已登录用户则绑定账号
        if (Yii::$app->user->isGuest) {
            //1、未登录用户
            if ($auth) { 
                //1.1未登录用户存在绑定记录直接登录
                $user = $auth->user;
                Yii::$app->user->login($user,3600*24*30);
            } else { 
                //1.2未登录用户不存在绑定记录跳到绑定或者创建账号页面
                $attr['source_name'] = $client->id;
                $session = Yii::$app->session;
                $session->set('authInfo', $attr);
                return $this->redirect(['auth-bind-account']);
            }
        } else { 
            //2、已登录用户
            if (!$auth) {
                //2.1 绑定
                $auth = new UserAuth(['user_id' => Yii::$app->user->id,'source' => (string)$client->id,'source_id' => (string)$attr['id']]);
                if ($auth->save()){
                    Yii::$app->getSession()->setFlash('success','绑定成功');
                }else{
                    Yii::$app->getSession()->setFlash('error','绑定失败');
                }
                return $this->redirect('/user/default/modify-bind-account');
            }else {
                //2.2 解绑
                if ($auth->user_id != Yii::$app->user->id){
                    //如果第三方账号已被绑定一个用户，则不能再绑定其他用户
                    Yii::$app->getSession()->setFlash('error','该账号已绑定其他用户，请使用其他账号进行绑定');
                }else{
                    if ($auth->delete()){
                        Yii::$app->getSession()->setFlash('success','解绑成功');
                    }else{
                        Yii::$app->getSession()->setFlash('error','解绑失败');
                    }
                }
                return $this->redirect('/user/default/modify-bind-account');
            }
        }
    }
    
    public function actionAuthBindAccount()
    {
        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $session = Yii::$app->session;
        if( !$session->has('authInfo') ) {
            return $this->redirect(['login']);
        }
        $attr = $session->get('authInfo');
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            $auth = new UserAuth(['user_id' => Yii::$app->user->id,'source' => (string)$attr['source_name'],'source_id' => (string)$attr['id']]);
            if ($auth->save()) {
                $session->remove('authInfo');
            } else {
                throw new ServerErrorHttpException(implode('<br />', $auth->getFirstErrors()));
            }
            return $this->goHome();
        } 
        return $this->render('authBindAccount', ['model' => $model,'authInfo' => $attr]);
    }
    
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();    
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', ['model' => $model]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    public function actionSignup()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();    
        }
        $model = new SignupForm();
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->getSession()->setFlash('success','注册成功，请检查你的邮箱 '.$model->email.'，请在1小时内完成验证'.Html::a('没收到邮件？',['find-password']));
            return $this->goHome();
        }
        return $this->render('signup', ['model' => $model]);
    }
    
    //注册的时候通过点击邮件链接激活账号
    public function actionActivateAccount($token)
    {
        $model = new SignupForm();
        $user = User::findByPasswordResetToken($token);
        if($model->removeToken($user)){
            $session = Yii::$app->session;
            $attr = $session->get('authInfo');
            if($attr) {
                $auth = new UserAuth(['user_id' => $user->id,'source' => $attr['source_name'],'source_id' => $attr['id']]);
                if ($auth->save()) {
                    $session->remove('authInfo');
                }
            }
            Yii::$app->getSession()->setFlash('success','邮件已经验证，请登录您的帐号');
            return $this->goHome();
        }else{
            Yii::$app->getSession()->setFlash('error','激活账号的令牌已经失效，请重新发送邮件激活您的账号');
            return $this->redirect('find-password');
        }
    }
    
    //忘记密码的时候通过发送邮件找回密码
    public function actionFindPassword()
    {
        $model = new FindPasswordForm();
        if($model->load(Yii::$app->request->post())){
            if($model->sendEmail()){
                Yii::$app->getSession()->setFlash('success', '邮件发送成功！请检查您的电子邮箱获得进一步操作说明。');
                return $this->goHome();
            }else{
                Yii::$app->getSession()->setFlash('error','抱歉，我们无法对提供的邮箱发送邮件');
            }
        }
        return $this->render('findPassword',['model'=>$model]);
    }
    
    //点击邮箱的链接跳转到新页面进行重置密码
    public function actionResetPassword($token)
    {
        $model = new ResetPasswordForm($token);
        if($model->load(Yii::$app->request->post()) && $model->resetPassword()){
            Yii::$app->getSession()->setFlash('success','新的密码已经生效，请重新登录您的帐号。');
            return $this->goHome();
        }
        return $this->render('resetPassword',['model'=>$model]);
    }
    
    //知道密码的情况下修改密码
    public function actionModifyPassword()
    {
        $model = new ModifyPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->modifyPassword()){
            Yii::$app->getSession()->setFlash('success','密码修改成功');
            return $this->refresh();
        }
        return $this->render('modifyPassword',['model'=>$model]);
    }
    
    //修改个人信息
    public function actionModifyInfo()
    {
        $info = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
        if ($info->load(Yii::$app->request->post()) && $info->save()){
            Yii::$app->getSession()->setFlash('success','个人信息修改成功');
            return $this->refresh();
        }
        return $this->render('modifyInfo',['info'=>$info]);
    }
    
    public function actionModifyBindAccount()
    {
        $user = Yii::$app->user->identity;
        return $this->render('modifyBindAccount',['user'=>$user]);
    }
    
    //修改个人头像
    public function actionModifyImage()
    {
        $image = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
        if ($image->load(Yii::$app->request->post())){
            if ($image->saveImage()){
                Yii::$app->getSession()->setFlash('success','成功更换头像');
            }else {
                Yii::$app->getSession()->setFlash('error','图片格式必须为jpg/png/jpeg/gif，且大小不能超过2M');
            }
            return $this->refresh();
        }
        return $this->render('modifyImage',['image'=>$image]);
    }
    
    //展示用户
    public function actionUsers()
    {
        $username = Yii::$app->request->get('username');
        if ($username){
            return $this->redirect(['search-user','username'=>$username]);
        }
        $res = User::find()->where(['status'=>10])->joinWith('userInfo')->orderBy(['score'=>SORT_DESC])->all();
        return $this->render('users', ['res' => $res]);
    }
    
    //搜索用户
    public function actionSearchUser($username=null)
    {
        $username = Yii::$app->request->get('username');
        $res = User::find()->andFilterWhere(['like','username',$username])->all();
        return $this->render('users',['res'=>$res]);
    }
    
    //在线用户
    public function actionOnlineUser()
    {
        $res = UserInfo::OnlineUser()->select(['user_id','score'])->all();
        return $this->render('users',['res'=>$res]);
    }
    
    //展示用户的个人信息
    public function actionShow($username)
    {
        $user = User::findOne(['username' => $username]);
        if ($user->exitVisitNotice){
            UserNotice::updateNotice($user->id,'visit');
        }else if (Yii::$app->user->id != $user->id){
            UserNotice::setNotice(Yii::$app->user->id,$user->id,'visit');
        }
        return $this->render('show',['user'=>$user]);
    }
    
    //展示用户的个人积分、粉丝数量、关注数量
    public function actionShowScore()
    {
        $user =  Yii::$app->user->identity;
        return $this->render('showScore',['user'=>$user]);
    }
    
    //展示全部粉丝列表，用在show页面
    public function actionShowFans()
    {
        return $this->render('showFans');
    }
    
    //展示全部关注列表
    public function actionShowFocus()
    {
        return $this->render('showFans');
    }
    
    //展示全部粉丝列表，用在showScore页面
    public function actionShowFans2()
    {
        return $this->render('showFans');
    }
    
    //展示全部关注列表
    public function actionShowFocus2()
    {
        return $this->render('showFans');
    }
    
    //签到
    public function actionSignin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->signin();
    }
    
    //今日签到会员
    public function actionSigninMember()
    {
        $model = new SigninForm();
        $member = $model->siginMembers();
        return $this->render('signinMember',['member'=>$member]);
    }
    
    //发送私信
    public function actionSendMessage($username='')
    {
        $model = new SendMessageForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendMessage()){
           Yii::$app->getSession()->setFlash('success','私信发送成功');
           return $this->refresh();
        }
        return $this->render('sendMessage',['model'=>$model,'username'=>$username]);
    }
    
    //私信列表
    public function actionListMessage()
    {
        $username = Yii::$app->user->identity->username;
        $where = ['to' => $username,'parent_id'=>'0'];
        $orWhere = ['from' => $username,'parent_id'=>'0'];
        $count = UserMessage::find()->where($where)->orWhere($orWhere)->count();
        $pages = new Pagination(['totalCount' =>$count,'pageSize' => Yii::$app->params['pageSize']['many']]);
        $message = UserMessage::find()->where($where)->orWhere($orWhere)->orderBy(['send_time'=>SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('listMessage',['message'=>$message,'pages'=>$pages]);
    }
    
    //查询和回复私信
    public function actionViewMessage($id)
    {
        $model = new UserMessage();
        $message = UserMessage::find()->where(['id'=>$id])->one();
        //防止用户通过url查看别人的私信
        if (!$message || Yii::$app->user->identity->username != $message->from && Yii::$app->user->identity->username != $message->to){
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post())){
            $from_user = Yii::$app->user->identity;
            $from = $from_user->username;
            $message->from == $from ? $model->to=$message->to: $model->to=$message->from;
            $model->from = $from;
            $model->parent_id = $id;
            $model->send_time = time();
            if ($model->validate() && $model->save()){
                UserNotice::setNotice($from_user->id, $model->toUser->id, 'message');
                return $this->refresh();
            }
        }
        return $this->render('viewMessage',['model'=>$model,'message'=>$message]);
    }
    
    //关注和取消关注    
    public function actionFocus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $focus_who = Yii::$app->request->get('username');
        if (empty($focus_who)) {
            throw new InvalidParamException('参数不合法');
        }
        if (empty(User::findOne(['username'=>$focus_who]))) {
            throw new NotFoundHttpException('用户不存在');
        }
        $from = Yii::$app->user->identity->username;
        $user_fans = UserFans::find()->where(['from' => $from,'to' => $focus_who])->one();
        if (empty($user_fans)) {
            $user_fans = new UserFans();
            $user_fans->from = $from;
            $user_fans->to = $focus_who;
            $user_fans->focus_time = time();
            $user_fans->save();
            UserNotice::setNotice($user_fans->fromUser->id, $user_fans->toUser->id, 'focus');
            return ['action' => 'focus'];
        } else {
            $user_fans->delete();
            UserNotice::deleteNotice('focus', $user_fans->toUser->id);
            return ['action' => 'no-focus'];
        }
    }
    
    //展示近七日网站的访问量
    public function actionShowVisit()
    {
        $sevenDaysZeroTime = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-7,date('Y')));
        $visit = VisitCount::find()->where(['>=','created_time',$sevenDaysZeroTime])->asArray()->all();
        $time = array_column($visit, 'created_time');
        $nums = array_column($visit, 'nums');
        return $this->render('showVisit',['time'=>$time,'nums'=>$nums]);
    }
    
    protected function performAjaxValidation($model)
    {
        //判断是否是ajax请求Yii::$app->request->isAjax
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            //设置返回的数据类型是JSON格式
            Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(\yii\widgets\ActiveForm::validate($model));
            //相当于die()
            Yii::$app->end();
        }
    }
    
    protected  function signin()
    {
        $userInfo = UserInfo::findOne(['user_id' => Yii::$app->user->id]);
        $yesterdayZeroTime = mktime(0,0,0,date('m')-1,date('d'),date('Y'));
        $todayZeroTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
        //如果昨天签到过，签到次数+1
        if ($userInfo->signin_time>$yesterdayZeroTime && $userInfo->signin_time<$todayZeroTime){
            $userInfo->signin_day++;
        }else{
            //如果昨天没有签到，或者从没有签到，连续签到次数=1
            $userInfo->signin_day=1;
        }
        $userInfo->signin_time = time();
        $userInfo->score ++;
        $userInfo->save();
        return ['days'=>$userInfo->signin_day];
    }
}