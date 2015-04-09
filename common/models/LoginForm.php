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
    public $errorType = self::ERROR_NON;
    private $_user = false;

    /**
     * 登录错误码
     */
    const ERROR_VALIDATE = 2;//普通验证错误
    const ERROR_WAITFINISH = 1;//等待注册完成即用户密码未填写错误
    const ERROR_NON= 0;// 0表示没有错误需要处理

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
            'rememberMe' => Yii::t('common', 'RememberMe'),
        ];
    }

    /**
     * 验证用户的内联方法，由rules调用进行验证
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if($user){
                /**
                 * 判断用户状态
                 */
                switch($user->status){
                    case User::STATUS_ACTIVE :
                        if(!$user->validatePassword($this->password)){
                            $this->addError('password', '邮箱或密码错误');
                        }
                        break;
                    case User::STATUS_WAITFINISH :
                        $this->errorType = self::ERROR_WAITFINISH;
                        $this->addError('password', '用户信息不完整');
                        break;
                    case User::STATUS_INACTIVE :
                        $this->addError('password', '用户未激活');
                        break;
                    case User::STATUS_BANNED :
                        $this->addError('password', '用户已冻结');
                        break;
                    case User::STATUS_DELETED :
                        $this->addError('password', '用户已经注销');
                        break;
                    default:
                        $this->addError('password', '用户数据不合法');
                        break;
                }
            } else {
                $this->addError('password', '邮箱未注册');
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
            switch($this->errorType){
                case self::ERROR_WAITFINISH :
                    return self::ERROR_WAITFINISH;//返回登录成功但是有错误类型，即需要处理的错误
                    break;
                default :
                    return false;//返回登录失败，错误类型为默认，即不需要处理的错误
                    break;
            }

        }
    }

    /**
     * 通过 [[email]] 查找用户信息
     * 魔术方法
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email,User::STATUS_ALL);
        }

        return $this->_user;
    }

}
