<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * 用户模型，用处极大
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 * 其中\yii\web\IdentityInterface是用户验证授权的抽象类
 *
 * This is the model class for table "user".
 * @property integer $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $login_count
 * @property integer $status
 * @property integer $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 *
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * 用户状态
     */
    const STATUS_ACTIVE = 10;
    const STATUS_WAITFINISH = 9;
    const STATUS_INACTIVE = 8;
    const STATUS_BANNED = 1;
    const STATUS_DELETED = 0;

    /**
     * 用户级别
     */
    const ROLE_GUEST = 10;
    const ROLE_USER = 9;
    const ROLE_ORGLEADER = 8;
    const ROLE_FIN = 7;
    const ROLE_ANALYTIC = 6;
    const ROLE_OPERATOR = 5;
    const ROLE_MANAGER = 4;
    const ROLE_MANAGLEADER = 3;
    const ROLE_SUPERMANAGER = 2;
    const ROLE_ADMIN = 1;
    const ROLE_SUPERADMIN = 0;

    /**
     * @var string 用户角色
     */
    protected $_role;

    /**
     * @var string 用户状态
     */
    protected $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            //自动用当前时间戳填充制定字段
            'timestamp' => [
                //yii自己预定义的行为
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     * 场景，针对不用场景，指定不同的激活属性
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenariosNew =
            [
                'register' => ['username', 'email', 'password', 'avatar', 'status', 'role', 'auth_key'],
                'login' => ['username', 'password', ],
                'password_reset_request' => ['email'],
//                'create' => ['username', 'email', 'password', 'avatar', 'open_id', 'status', 'role', ],
//
//
//                'reset_password' => ['password'],
//                 'updated' => ['username', 'password'],
//
//                 'updated' => ['username', 'email', 'status', 'role', 'password', 'organization_id'],
//                 'created' => ['username', 'email', 'status', 'role', 'password', 'organization_id'],
//                 'delete' => [],
            ];
        return array_merge($scenarios,$scenariosNew);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'login_count', 'status', 'role', 'developer_id'], 'integer'],
            [['auth_key'], 'required'],
            [['username'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 64],
            [['avatar', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['oauth_id'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('user', 'User ID'),
            'username' => Yii::t('user', 'Username'),
            'email' => Yii::t('user', 'Email'),
            'password' => Yii::t('user', 'Password'),
            'avatar' => Yii::t('user', 'Avatar'),
            'created_at' => Yii::t('user', 'Created At'),
            'updated_at' => Yii::t('user', 'Updated At'),
            'login_count' => Yii::t('user', 'Login Count'),
            'status' => Yii::t('user', 'Status'),
            'role' => Yii::t('user', 'Role'),
            'oauth_id' => Yii::t('user', 'Oauth ID'),
            'auth_key' => Yii::t('user', 'Auth Key'),
            'password_hash' => Yii::t('user', 'Password Hash'),
            'password_reset_token' => Yii::t('user', 'Password Reset Token'),
            'developer_id' => Yii::t('user', 'Developer ID'),
        ];
    }


    /**
     * @return string 返回角色标签
     */
    public function getRoleLabel()
    {
        if ($this->_role === null) {
            $roles = self::getRoleArray();
            if (!empty($roles[$this->role])) {
                $this->_role = $roles[$this->role];
            }
        }
        return $this->_role;
    }

    /**
     * @return array 返回角色标签数组
     */
    public static function getRoleArray()
    {
        return [
            self::ROLE_GUEST => '访客-10',
            self::ROLE_USER => '用户-9',
            self::ROLE_ORGLEADER => '经理（合伙人）-8',
            self::ROLE_FIN => '财务-7',
            self::ROLE_ANALYTIC => '数据分析师-6',
            self::ROLE_OPERATOR => '运营商-5',
            self::ROLE_MANAGER => '经理-4',
            self::ROLE_MANAGLEADER => '领导-3',
            self::ROLE_SUPERMANAGER => '高级领导-2',
            self::ROLE_ADMIN => '管理员-1',
            self::ROLE_SUPERADMIN => '超级管理员-0'
        ];
    }

    /**
     * @return string 返回状态标签
     */
    public function getStatusLabel()
    {
        if ($this->_status === null) {
            $statuses = self::getStatusArray();
            $this->_status = $statuses[$this->status];
        }
        return $this->_status;
    }

    /**
     * @return array 返回状态标签数组
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => '激活',
            self::STATUS_WAITFINISH => '待完成注册',
            self::STATUS_INACTIVE => '未激活',
            self::STATUS_BANNED => '冻结',
            self::STATUS_DELETED => '删除',
        ];
    }

    /**
     * 通过用户名查找用户身份
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //findOne是ActiveRecord的方法
        return self::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 通过邮箱查找用户
     * @param  string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 通过用户ID查找用户
     * @param $uid
     * @internal param string $uid
     * @return static|null
     */
    public static function findByUserId($uid)
    {
        return self::findOne(['user_id' => $uid, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 通过 password reset token 查找用户
     * @param  string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        if ($timestamp + $expire < time()) {
            // token 过期
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * 通过 $token 查找用户
     * @param $token
     * @return bool|static
     */
    public static function findByAuthKey($token)
    {
        if ($token) {
            return static::findOne([
                'auth_key' => $token,
                'status' => self::STATUS_ACTIVE,
            ]);
        }
        else {
            return false;
        }

    }

    /**
     * 验证密码
     * @param  string $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * 设置哈希密码
     * @param string $password
     */
    public function setHashPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 生成验证密钥
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 生成access_token
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->getSecurity()->generateRandomString();
    }

    /**
     * 生成重置令牌
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 移除重置令牌
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getauth_user()
    {
        return $this->hasOne(AuthUser::className(), ['uid' => 'user_id']);
    }




    /**
     * 必须实现的方法1，通过ID查找用户身份
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 必须实现的方法2，通过访问令牌查找用户身份
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * 必须实现的方法3，返回可以唯一识别用户身份的ID
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 必须实现的方法4，返回授权密钥
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * 必须实现的方法5，验证密钥
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


}
