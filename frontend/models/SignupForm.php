<?php
namespace frontend\models;

use common\models\User;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\models\AvatarFile;

use Yii;

/**
 * Signup form
 */
class SignupForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $password;
    public $checkPassword;
    public $avatar;
    public $openId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个用户名已经被注册.'],
            ['username', 'string', 'min' => 2, 'max' => 30],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '您的邮箱已经注册过了.'],

            [['password', 'checkPassword'], 'required'],
            ['password', 'string', 'min' => 6],
            ['checkPassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不一样'],

            ['avatar', 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png', 'wrongExtension' => '文件格式不对',
                'maxSize' => 209715, 'tooBig' => '文件不能超过 200KB. 请上传一份更小的文件.'],
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
     *
     * @param string $avatar
     * @return User|null the saved model or null if saving fails
     */
    public function signup($avatar = '')
    {
        if ($this->validate()) {
            $user = new User(['scenario' => 'signup']);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setHashPassword($this->password);
            $user->generateAuthKey();
            $user->password = md5($this->password);
            //首先判断用户是否选择了图片文件，再判断是否有第三方抓取的照片，都没有就使用gravatar
            $user->avatar = UploadedFile::getInstance($this, 'avatar') ? $this->saveAvatar(UploadedFile::getInstance($this, 'avatar')) : ($avatar ? $this->saveAvatar($avatar) : md5($this->email));
            //dump($user->avatar);die();
            $user->open_id = $this->openId ? $this->openId : '0';
            if ($user->save()) {
                return $user;
            } else {
                echo "<script> window.alert(\"完成注册失败，请检查你的填写\");</script>";
                return false;
            }
            // dump($user->save());
            // die();
        }
        return null;
    }

    //保存图片
    public function saveAvatar($avatarUploadedFile)
    {

        // dump($avatarUploadedFile);die();
        //有上传文件
        if ($avatarUploadedFile != null) {

            $path = Yii::getAlias("@webroot/avatar/");

            if (isset($avatarUploadedFile->tempName)) {
                $filename = date('YmdHis') . '_' . md5($avatarUploadedFile->name)
                    . '.' . $avatarUploadedFile->extension;
                $type = $avatarUploadedFile->type;
                $avatarUploadedFile->saveAs($path . $filename);
            } else {
                $type = strrchr($avatarUploadedFile, ".");
                $filename = $avatarUploadedFile;
            }

            Image::thumbnail($path . $filename, 40, 40)->save($path . 'SMALL' . $filename);
            Image::thumbnail($path . $filename, 150, 150)->save($path . 'MIDDLE' . $filename);

            $arr = ['', 'MIDDLE', 'SMALL'];

            foreach ($arr as $value) {
                $avatarFile = new AvatarFile;
                $avatarFile->contentType = $type;
                $avatarFile->file = $path . $value . $filename;
                $avatarFile->filename = $value . $filename;
                if ($avatarFile->save() !== true)
                    return false;
                else {
                    @unlink($path . $value . $filename);
                }
            }
            return $filename;
        } //没有上传，尝试使用gravatar邮箱链接的头像
        else {
            return md5($this->email);
        }

    }


}
