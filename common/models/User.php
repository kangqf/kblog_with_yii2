<?php
/**
 * @link http://kangqingfei.com/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

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
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $login_count
 * @property integer $status
 * @property integer $role
 * @property string $oauth_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $developer_id
 *
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * 用户状态
     */
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 9;
    const STATUS_BANNED = 1;
    const STATUS_DELETED = 0;

    /**
     * 用户级别
     */
    const ROLE_USER = 10;
    const ROLE_ORG = 9;
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
    public function rules()
    {
        return [
            [['created_time', 'updated_time', 'login_count', 'status', 'role', 'developer_id'], 'integer'],
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
            'user_id' => Yii::t('common', 'User ID'),
            'username' => Yii::t('common', 'Username'),
            'email' => Yii::t('common', 'Email'),
            'password' => Yii::t('common', 'Password'),
            'avatar' => Yii::t('common', 'Avatar'),
            'created_time' => Yii::t('common', 'Created Time'),
            'updated_time' => Yii::t('common', 'Updated Time'),
            'login_count' => Yii::t('common', 'Login Count'),
            'status' => Yii::t('common', 'Status'),
            'role' => Yii::t('common', 'Role'),
            'oauth_id' => Yii::t('common', 'Oauth ID'),
            'auth_key' => Yii::t('common', 'Auth Key'),
            'password_hash' => Yii::t('common', 'Password Hash'),
            'password_reset_token' => Yii::t('common', 'Password Reset Token'),
            'developer_id' => Yii::t('common', 'Developer ID'),
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
            self::ROLE_USER => '用户',
            self::ROLE_ORG => '运营商（合作伙伴）-9',
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
            self::STATUS_INACTIVE => '未激活',
            self::STATUS_BANNED => '冻结',
            self::STATUS_DELETED => '删除',
        ];
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
