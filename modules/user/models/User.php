<?php
namespace modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use modules\post\models\Post;
use yii\helpers\Html;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'User ID'),
            'username' => Yii::t('user', 'Username'),
            'password_reset_token' => Yii::t('user', 'Password Reset Token'),
            'status' => Yii::t('user', 'Status'),
            'email' => Yii::t('user', 'Email'),
            'registration_ip' => Yii::t('user', 'Registration Ip'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
    
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
        ];
    }
    
    public function getStatusName()
    {
        switch ($this->status){
            case '10':
                return '已激活';
                break;
            case '0':
                return '未激活';
                break;
            default:
                return NUll;
                break;
        }
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne(['password_reset_token' => $token]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        //substr() 函数返回字符串的一部分
        //strrpos() 函数查找字符串在另一字符串中最后一次出现的位置
        //由于传入的$token是Bfe5gCKLvTVxjjPr5QgnZNgXhgRFqsBQ_1456996433这种形式的，截取_后面的unix时间戳
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        //表示保存的时间，user.passwordResetTokenExpire定义在params.php文件中
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        //如果$token是之前的unix时间戳+保存的时间 >= 当前Unix时间，则表示重置密码的令牌还未过期
        //如果令牌过期了，则返回flase
        return $timestamp + $expire >= time();
    }

    public static function isGuest()
    {
        return Yii::$app->user->isGuest;
    }
    
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    //当前用户的（cookie）认证密钥
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    //当一个用户为第一次使用，提供了一个密码时（比如：注册时），密码就需要被哈希化
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    //用户注册时生成的随机字符串
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //重置用户的password_reset_token
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }
    
    public function getUserNotice()
    {
        //群发站内信的思路：新建一张表，当用户访问网站的时候判断私信表中是否有群发的字段，没有则在私信表创建中字段，同时设置提醒
        $to = Yii::$app->user->identity->username;
        $SysContent = MassMessage::find()->all();
        foreach ($SysContent as $key=>$val){
            $admin = $this->findOne(['id'=>$val->admin_id])['username'];
            if($admin!==$to && !UserMessage::findOne(['from'=>$admin,'to'=>$to,'content'=>$val->content])){
                $model = new UserMessage();
                $model->from = $admin;
                $model->to = $to;
                $model->content = $val->content;
                $model->send_time = $val->created_at;
                $model->save();
                UserNotice::setNotice($val->admin_id,Yii::$app->user->id, 'system',$val->created_at);
            }
        }
        return UserNotice::find()->where(['to_user_id'=>$this->id,'is_read'=>'0'])->all();
    }
    
    public function getUserNoticeCount()
    {
        return UserNotice::find()->where(['to_user_id'=>$this->id,'is_read'=>'0'])->count();
    }
    
    public function getExitVisitNotice()
    {
        return UserNotice::find()->where(['to_user_id'=>$this->id,'type'=>'visit','from_user_id'=>Yii::$app->user->id])->one();
    }
    
    public function getUserPostNum()
    {
        return Post::find()->where(['user_id'=>$this->id])->count();
    }
    
    public function getFansNum()
    {
        return UserFans::find()->where(['to'=>$this->username])->count();
    }
    
    public function getFocusNum()
    {
        return UserFans::find()->where(['from'=>$this->username])->count();
    }
    
    public function getShowFans()
    {
        return UserFans::find()->where(['to'=>$this->username])->all();
    }
    
    public function getShowFocus()
    {
        return UserFans::find()->where(['from'=>$this->username])->all();
    }
    
    public function showImage($option=['width'=>'35','height'=>'35'],$class= 'img-circle')
    {
        return Html::img(Yii::$app->params['imageDomain'].'/'.$this->userInfo['image'],['width'=> $option['width'],'height'=>$option['height'],'class'=> $class,'alt'=>$this->username]);
    }
    
    public function getIsBind($source)
    {
        if (UserAuth::findOne(['user_id'=>Yii::$app->user->id,'source'=>$source])){
            return '解绑';
        }else{
            return '绑定';
        }
    }
}