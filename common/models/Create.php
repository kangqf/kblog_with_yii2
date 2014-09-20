<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-9-19
 * Time: 下午10:54
 */

namespace common\models;

use Yii;
use common\models\User;

class Create extends \yii\base\Model
{
    public $status;
    public $role;
    public $username;
    public $email;
    public $password;


    /**
     * 用户状态
     * - 激活
     * - 未激活
     * - 禁止
     * - 删除
     */
//    const STATUS_ACTIVE = 10;
//    const STATUS_INACTIVE = 9;
//    const STATUS_BANNED = 1;
//    const STATUS_DELETED = 0;
//
//    /**
//     * 用户级别
//     */
//    const ROLE_USER = 10;
//    const ROLE_ORG = 9;
//    const ROLE_ORGLEADER = 8;
//    const ROLE_FIN = 7;
//    const ROLE_ANALYTIC = 6;
//    const ROLE_OPERATOR = 5;
//    const ROLE_MANAGER = 4;
//    const ROLE_MANAGLEADER = 3;
//    const ROLE_SUPERMANAGER = 2;
//    const ROLE_ADMIN = 1;
//    const ROLE_SUPERADMIN = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
//            [['role'], 'default', 'value' => self::ROLE_USER],



            ['status', 'required'],
            ['role', 'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个用户名已经被注册.'],
            ['username', 'string', 'min' => 2, 'max' => 30],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个邮箱已经注册过了.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

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
            'username' => '用户名',
            'status' => '状态',
            'role' => '级别',

        ];
    }
    public function create()
    {
        if ($this->validate()) {
            $user = new User(['scenario' => 'create']);

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setHashPassword($this->password);
            $user->generateAuthKey();
            $user->password = md5($this->password);
            $user->role = $this->role;
            $user->status = $this->status;
//            dump($this);die();
            //首先判断用户是否选择了图片文件，再判断是否有第三方抓取的照片，都没有就使用gravatar
            $user->avatar = md5($this->email);
            $user->open_id =  '0';
//            dump($user);
//            dump($user->save());die();
            if ($user->save()) {
                return $user;
            } else {
                echo "<script> window.alert(\"用户创建失败，请检查你的填写\");</script>";
                return false;
            }
            // dump($user->save());
            // die();
        }
        return null;
    }
}