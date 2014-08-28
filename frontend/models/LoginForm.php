<?php

namespace frontend\models;

use Yii;
use common\models\User;

class LoginForm extends \yii\base\Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 验证密码
     * 验证密码的内联方法
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', '邮箱或密码错误');
            }
        }
    }

    /**
     * 用用户名和密码登陆
     *
     * @return boolean 是否登陆成功
     */
    public function login()
    {
        if ($this->validate()) {
            $this->_user->scenario = 'login';
            $this->_user->login_count++;

            if ($this->_user->save()) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            } else {
                return false;
            }
            //  $user = new User(['scenario' => 'login']);
            // dump($this->getUser());die();

        } else {
            return false;
        }
    }

    /**
     * 通过 [[username]] 查找用户信息
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'email' => '输入的邮箱',
            'password' => '密码',
            'rememberMe' => '自动登录',
        ];
    }

}
