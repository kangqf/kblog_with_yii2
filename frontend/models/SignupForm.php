<?php
namespace frontend\models;

use common\models\User;

use Yii;

/**
 * Signup form
 */
class SignupForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $password;
    public $avatar;

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

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['avatar', 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png','wrongExtension' => '文件格式不对',
            'maxSize'=>209715, 'tooBig' => '文件不能超过 200KB. 请上传一份更小的文件.'],
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'username' => Yii::t('site/user', 'Имя пользователя'),
            'email' => '邮箱',
            'password' => '密码',
            'username' => '用户名',
            'avatar' => '头像',
            ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate())
        {
            $user = new User(['scenario' => 'signup']);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setHashPassword($this->password);
            $user->generateAuthKey();
            $user->password = md5($this->password);
            if($user->save())
            {
              return $user;
            }
            else{
              return false;
            }
            // dump($user->save());
            // die();


        }

        return null;
    }
}
