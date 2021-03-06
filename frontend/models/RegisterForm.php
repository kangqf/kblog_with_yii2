<?php
 /**
  * @link http://kangqingfei.cn/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\InvalidCallException;
use yii\web\UploadedFile;

/**
 * 用户注册模型
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class RegisterForm extends \yii\base\model
{
    public $username;
    public $email;
    public $password;
    public $checkPassword;
    public $avatar;



    /**
     * @inheritdoc
     * 场景，针对不用场景，指定不同的激活属性
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenariosNew =
            [
                'register' => ['username', 'email', 'password', 'avatar',],
                'finishRegister' => ['username', 'password', 'email', ],

        ];
        return array_merge($scenarios,$scenariosNew);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个用户名已经被注册.','on' => 'register'],
            ['username', 'string', 'min' => 2, 'max' => 30],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '您的邮箱已经注册过了.','on' => 'register'],

            [['password', 'checkPassword'], 'required'],
            ['password', 'string', 'min' => 6],
            ['checkPassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不一样'],

            ['avatar', 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png', 'wrongExtension' => '文件格式不对',
                'maxSize' => 209715, 'tooBig' => '图片不能超过 200KB. 请上传一份更小的图片.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => '邮箱',
            'password' => '密码',
            'checkPassword' => '确认密码',
            'username' => '用户名',
            'avatar' => '头像',

        ];
    }


    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @internal param string $avatar
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User(['scenario' => 'register']);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setHashPassword($this->password);
            $user->generateAuthKey();
            $user->generateAccessToken();
            $user->password = md5($this->password);
            if($this->saveAvatar(UploadedFile::getInstance($this, 'avatar')))
                $user->avatar = $this->avatar;
            else {
                Yii::$app->session->setFlash('alert', '注册失败');
                Yii::$app->session->setFlash('alert-type', 'alert-danger');
                return false;
            }

            if ($user->save()) {
                return $user;
            }
            else {
                Yii::$app->session->setFlash('alert', '注册失败');
                Yii::$app->session->setFlash('alert-type', 'alert-danger');
                return false;
            }
        }
        return null;
    }

    public function finishRegister($uid)
    {
        if ($this->validate()) {
            $user = User::findByUserId($uid,User::STATUS_WAITFINISH);
            if($user) {
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setHashPassword($this->password);
                $user->password = md5($this->password);
                $user->status = User::STATUS_ACTIVE;
                $av = UploadedFile::getInstance($this, 'avatar');
                if($av){
                    if($this->saveAvatar(UploadedFile::getInstance($this, 'avatar')))
                        $user->avatar = $this->avatar;
                    else {
                        return false;
                    }
                }

                if ($user->save()) {
                    return $user;
                }
                else {
                    Yii::$app->session->setFlash('alert', '注册失败');
                    Yii::$app->session->setFlash('alert-type', 'alert-danger');
                    return false;
                }
            } else {
                throw new InvalidCallException('finish register failed');
            }
        }
        return null;
    }


    /**
     * 保存图片
     * @param $avatarUploadedFile
     * @return bool
     */
    public function saveAvatar($avatarUploadedFile)
    {

        //首先判断用户是否选择了图片文件，有就上传到七牛云
        if($avatarUploadedFile) {
            $fileName = md5($this->email).'.'.$avatarUploadedFile->getExtension();
            //存储到本地先
            if($avatarUploadedFile->saveAs(Yii::getAlias('@upload/images/') . $fileName))
            {
                $fileContent = Yii::$app->fileSystem->read('local://' . $fileName);
                $qiniu = Yii::$app->fileSystem->get('qiniu');
                //上传到七牛
                if($qiniu->write('qiniu://'.$fileName,$fileContent)) {
                    $this->avatar = $qiniu->getUrl($fileName);
                    return true;
                }else{
                    $this->avatar = 'http://www.gravatar.com/avatar/' . md5($this->email);
                    return true;
                }
            }
            //存储到本地失败
            else{
                $this->avatar = 'http://www.gravatar.com/avatar/' . md5($this->email);
                return true;
            }
        }
        //没有上传，尝试使用gravatar邮箱链接的头像
        else {
            //抓取gavatar到七牛云
            $qiniu = Yii::$app->fileSystem->get('qiniu');
            $fileName =  md5($this->email);
            if($qiniu->urlCopy('http://www.gravatar.com/avatar/' . $fileName . '?s=500&d=retro',$fileName)) {
                $this->avatar = $qiniu->getUrl($fileName);
                return true;
            }
            else {
                //抓取失败gavatar失败 使用gavatar地址
                $this->avatar = 'http://www.gravatar.com/avatar/' . md5($this->email);
                return true;
            }
        }
    }









    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageFile()
    {
        return isset($this->avatar) ? Yii::$app->params['uploadPath'] . $this->avatar : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->avatar) ? $this->avatar : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . $avatar;
    }

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->filename = $image->name;
        $ext = end( ( explode("." , $image->name) ) );

        // generate a unique file name
        $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->avatar = null;
        $this->filename = null;

        return true;
    }
}