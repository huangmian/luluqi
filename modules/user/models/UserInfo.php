<?php
namespace modules\user\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

class UserInfo extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_info}}';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex', 'qq','score','signin_time','signin_day','last_login_time'], 'integer'],
            [['location','birthday','image','signature'], 'string', 'max' => 255]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'signin_time' => Yii::t('user','Signin Time'),
            'signin_day' => Yii::t('user','Signin Day'),
            'image' => Yii::t('user', 'Image'),
            'score' => Yii::t('user', 'Score'),
            'sex' => Yii::t('user', 'Sex'),
            'signature' => Yii::t('user', 'Signature'),
            'qq' => Yii::t('user', 'QQ'),
            'location' => Yii::t('user', 'Location'),
            'birthday' => Yii::t('user','Birthday'),
            'message' => Yii::t('user', 'Message'),
            'message_from' => Yii::t('user', 'Message From'),
            'last_login_time' => Yii::t('user', 'Last Login Time'),
        ];
    }
    
    public function getSexName() 
    {
        switch ($this->sex){
            case '0':
                return '男';
            break;
            case '1':
                return '女';
            break;
            case '2':
                return '保密';
            default:
                return NUll;
            break;
        }
    }
    
    //下拉筛选
    public static function dropDown ($column, $value = null)
    {
        $dropDownList = [
            "sex"=> [
                "0"=>"男",
                "1"=>"女",
                '2'=>'保密',
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null){
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
            //返回关联数组，用户下拉的filter实现
        }else{
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }
    
    public function saveImage()
    {
        $image = UploadedFile::getInstance($this, 'image');
        if($image === NULL || !in_array($image->getExtension(), ['jpg','png','jpeg','gif']) || $image->size > 200000){
            return null;
        }
        $imageName = md5(time().$image->name).'.'.$image->getExtension();
        $userPath = 'userImage/'.$this->user_id;
        $path = Yii::getAlias('@images').'/'.$userPath;
        $pic = $userPath.'/'.$imageName;
        //创建文件夹
        if (!is_dir($path) && !mkdir($path,0777,true) && chmod($path,0777)) {
            return null;
        }
        //保存图片
        /* if (!$image->saveAs($path.'/'.$imageName)) {
            return null;
        } */
        if (!move_uploaded_file($image->tempName, $path.'/'.$imageName)) {
            return null;
        }
        //如果不是默认的头像，用户更新头像的时候删除之前更新过的头像，避免默认头像被删除
        //这里$modle->image=null，所以得重新获取image，原因：可能是前面被置空了
        $user_info = UserInfo::findOne(['user_id'=>$this->user_id]);
        if($user_info->image !== \Yii::$app->params['defaultUserImage']){
            if(isset($user_info->image) && $user_info->image!=null){
                unlink(Yii::getAlias('@images').'/'.$user_info->image);
            }
        }
        if ($this->validate()){
            $user_info->image = $pic;
            return $user_info->save();
        }
    }
    
    public function getUser()
    {
        return User::findOne(['id'=>$this->user_id]);
    }
    
    public static function ExitLogin()
    {
        $user_info = self::findOne(['user_id'=>Yii::$app->user->id]);
        $user_info['last_login_time'] = time();
        $user_info->save();
    }
    
    public static function OnlineUser()
    {
        return self::find()->where(['>','last_login_time',time()-60*30]);
    }
}