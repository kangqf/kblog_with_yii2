<?php
 /**
  * @link http://kangqingfei.com/
  * @copyright Copyright (c) 2015 kangqingfei
  * @license MIT
  */
namespace common\models;

use Yii;

/**
 * 登录模型
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
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
            // username 和 password 不能为空
            [['email', 'password'], 'required'],
            // email 必须满足邮箱的格式
            [['email'], 'email'],
            // rememberMe必须是bool型
            ['rememberMe', 'boolean'],
            // 调用validatePassword()来验证密码
            ['password', 'validatePassword'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('common', 'Email'),
            'password' => Yii::t('common', 'Password'),
            'rememberMe' => Yii::t('common', '记住密码'),
        ];
    }

    /**
     * 验证密码的内联方法，由rules调用进行验证
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
        }
        else {
            return false;
        }
    }

    /**
     * 通过 [[username]] 查找用户信息
     * 魔术方法
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

}
